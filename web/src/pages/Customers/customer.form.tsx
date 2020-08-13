import React, { useEffect, useState, useCallback } from 'react';
import { useWindowWidth } from '@react-hook/window-size';
import { Formik, FormikProps } from 'formik';
import 'formik-antd/es/form/style';
import Form from 'formik-antd/es/form';

import Button from 'components/Button';
import Row from 'components/Row';
import Column from 'components/Column';
import Modal from 'components/Modal';
import Input from 'components/Form/Input';
import FormControl from 'components/Form/FormControl';
import User from 'modules/Users/user.entity';
import userService from 'modules/Users/user.service';
import FormDivider from 'components/Form/FormDivider';
import Radio from 'components/Form/Radio';

interface CustomerFormProps {
  visible: boolean;
  onClose(): void;
  recordID: number | null;
}

const initialValues: any = {
  active: true,
};

const UserForm: React.FC<CustomerFormProps> = ({
  visible,
  onClose: close,
  recordID,
}) => {
  let formik: FormikProps<User>;
  const size = useWindowWidth();
  const [recordData, setRecordData] = useState<User>(initialValues);

  useEffect(() => {
    const fetchData = async (id: number) => {
      const user = await userService.read(id);
      setRecordData(user || initialValues);
    };

    if (recordID) {
      fetchData(recordID);
    }
  }, [recordID]);

  const handleSubmit = useCallback(async (createUserData) => {
    console.log(createUserData);
    const user = createUserData.id
      ? await userService.update(createUserData, formik)
      : await userService.create(createUserData, formik);

    user && handleClose();
  }, []);

  const handleClose = () => {
    setRecordData(initialValues);
    formik.resetForm();
    close();
  };

  const businessOptions = [
    {
      value: 'fisica',
      label: 'Física',
    },
    {
      value: 'juridica',
      label: 'Jurídica',
    },
  ];

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
              <Row>
                <Column xs={24}>
                  <FormDivider text="Informações Pessoais" color="primary" />
                </Column>

                <Column xs={6}>
                  <FormControl label="Pessoa" field="business">
                    <Radio name="business" options={businessOptions} />
                  </FormControl>
                </Column>
                <Column xs={18}>
                  <FormControl label="Pessoa" field="business">
                    <Input
                      type="text"
                      name="name"
                      placeholder="João da Silva"
                    />
                  </FormControl>
                </Column>

                <Column xs={12}>
                  <FormControl label="Apelido" field="nickname">
                    <Input
                      type="text"
                      name="nickname"
                      placeholder="Joãozinho"
                    />
                  </FormControl>
                </Column>
                <Column xs={12}>
                  <FormControl label="E-mail" field="email">
                    <Input
                      type="text"
                      name="email"
                      placeholder="joao@silva.com"
                    />
                  </FormControl>
                </Column>

                <Column xs={12}>
                  <FormControl label="Telefone" field="phone">
                    <Input
                      type="text"
                      name="phone"
                      placeholder="(19) 9 3535-5555"
                    />
                  </FormControl>
                </Column>
                <Column xs={12}>
                  <FormControl label="Celular" field="mobile">
                    <Input
                      type="text"
                      name="mobile"
                      placeholder="(19) 9 9999-9999"
                    />
                  </FormControl>
                </Column>

                <Column xs={12}>
                  <FormControl label="RG" field="rg">
                    <Input type="text" name="rg" placeholder="9.999.999-X" />
                  </FormControl>
                </Column>
                <Column xs={12}>
                  <FormControl label="CPF" field="cpf">
                    <Input
                      type="text"
                      name="cpf"
                      placeholder="999.999.999-99"
                    />
                  </FormControl>
                </Column>

                <Column xs={24}>
                  <FormDivider text="Endereço" color="primary" />
                </Column>

                <Column xs={4}>
                  <FormControl label="CEP" field="zipcode">
                    <Input type="text" name="zipcode" placeholder="99999-999" />
                  </FormControl>
                </Column>

                <Column xs={2}>
                  <FormControl label="Estado" field="state">
                    <Input type="text" name="state" placeholder="SP" />
                  </FormControl>
                </Column>

                <Column xs={10}>
                  <FormControl label="Cidade" field="city">
                    <Input type="text" name="city" placeholder="Rio Claro" />
                  </FormControl>
                </Column>

                <Column xs={8}>
                  <FormControl label="Bairro" field="neighborhood">
                    <Input
                      type="text"
                      name="neighborhood"
                      placeholder="Centro"
                    />
                  </FormControl>
                </Column>

                <Column xs={20}>
                  <FormControl label="Endereço" field="address">
                    <Input
                      type="text"
                      name="address"
                      placeholder="Rua João da Silva"
                    />
                  </FormControl>
                </Column>

                <Column xs={4}>
                  <FormControl label="Número" field="number">
                    <Input type="text" name="number" placeholder="1234" />
                  </FormControl>
                </Column>
              </Row>
            </Form>
          </Modal>
        );
      }}
    </Formik>
  );
};

export default UserForm;
