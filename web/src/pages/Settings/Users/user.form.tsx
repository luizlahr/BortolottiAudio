import React, { useEffect, useState, useCallback } from 'react';
import { useWindowWidth } from '@react-hook/window-size';
import { Formik, FormikProps } from 'formik';
import 'formik-antd/es/form/style';
import Form from 'formik-antd/es/form';

import Button from 'components/Button';
import If from 'components/If';
import Row from 'components/Row';
import Column from 'components/Column';
import Modal from 'components/Modal';
import Input from 'components/Form/Input';
import Switch from 'components/Form/Switch';
import Password from 'components/Form/Password';
import FormControl from 'components/Form/FormControl';
import User from 'modules/Users/user.entity';
import userService from 'modules/Users/user.service';

interface UserFormProps {
  visible: boolean;
  onClose(): void;
  recordID: number | null;
}

const initialValues: any = {
  active: true,
};

const UserForm: React.FC<UserFormProps> = ({
  visible,
  onClose: close,
  recordID,
}) => {
  let formik: FormikProps<User>;
  const size = useWindowWidth();
  const [recordData, setRecordData] = useState<User>(initialValues);
  const [loading, setLoading] = useState<boolean>(false);

  useEffect(() => {
    try {
      const fetchData = async (id: number) => {
        setLoading(true);
        const user = await userService.read(id);
        setRecordData(user || initialValues);
        setLoading(false);
      };

      if (recordID) {
        fetchData(recordID);
      }
    } catch (exception) {
      console.log(exception);
    }
  }, [recordID]);

  const handleSubmit = useCallback(async (createUserData) => {
    setLoading(true);
    const user = createUserData.id
      ? await userService.update(createUserData, formik)
      : await userService.create(createUserData, formik);

    user && handleClose();
    setLoading(false);
  }, []);

  const handleClose = () => {
    setRecordData(initialValues);
    formik.resetForm();
    close();
  };

  return (
    <Formik
      onSubmit={handleSubmit}
      initialValues={recordData}
      enableReinitialize
    >
      {(bag) => {
        formik = bag;
        return (
          <Modal
            visible={visible}
            loading={loading}
            title="Novo Usuário"
            onClose={() => handleClose()}
            color="primary"
            destroyOnClose={true}
            width={size <= 1024 ? '100%' : '60%'}
            footer={
              <>
                <Button solid onClick={handleClose}>
                  Cancelar
                </Button>
                <Button solid onClick={formik.submitForm} color="primary">
                  Salvar
                </Button>
              </>
            }
          >
            <Form>
              <Input type="hidden" name="id" />
              <Row>
                <Column xs={24}>
                  <FormControl
                    label="Ativo ?"
                    field="active"
                    error={formik.errors.active}
                  >
                    <Switch
                      name="active"
                      checkedChildren="Sim"
                      unCheckedChildren="Não"
                    />
                  </FormControl>
                </Column>
              </Row>
              <Row>
                <Column xs={12}>
                  <FormControl
                    label="Nome"
                    field="name"
                    error={formik.errors.name}
                  >
                    <Input
                      type="text"
                      name="name"
                      placeholder="João da Silva"
                    />
                  </FormControl>
                </Column>

                <Column xs={12}>
                  <FormControl
                    label="E-mail"
                    field="email"
                    error={formik.errors.email}
                  >
                    <Input
                      type="text"
                      name="email"
                      placeholder="joao@silva.com"
                    />
                  </FormControl>
                </Column>
              </Row>
              <If test={!!recordID === false}>
                <Row>
                  <Column xs={12}>
                    <FormControl
                      field="password"
                      label="Senha"
                      error={formik.errors.password}
                    >
                      <Password
                        type="password"
                        name="password"
                        autoComplete="none"
                        placeholder="Senha"
                      />
                    </FormControl>
                  </Column>

                  <Column xs={12}>
                    <FormControl
                      label="Conf. Senha"
                      field="passwordConfirm"
                      error={formik.errors.passwordConfirm}
                    >
                      <Password name="passwordConfirm" placeholder="1234" />
                    </FormControl>
                  </Column>
                </Row>
              </If>
            </Form>
          </Modal>
        );
      }}
    </Formik>
  );
};

export default UserForm;
