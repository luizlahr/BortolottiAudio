import React from 'react';
import Modal from 'components/Modal'
import Input from 'components/Form/Input';
import Row from 'components/Row';
import Column from 'components/Column';
import FormControl from 'components/Form/FormControl';
import { useWindowWidth } from '@react-hook/window-size'
import Button from 'components/Button';
import Form from 'formik-antd/es/form';
import 'formik-antd/es/form/style';
import { Formik } from 'formik'

interface ICustomerForm {
  visible: boolean;
  onClose(): void;
}

const CustomerForm: React.FC<ICustomerForm> = ({ visible, onClose }) => {
  const size = useWindowWidth();

  const handleSubmit = (data: object) => {
    console.log(data);
  }

  return (
    <Formik onSubmit={(values) => { console.log(values) }} initialValues={{ business: false }} enableReinitialize>
      {({ submitForm }) => (
        <Modal
          visible={visible}
          title="Nova Conta Bancária"
          onClose={onClose}
          color="primary"
          width={size <= 1024 ? "100%" : "60%"}
          footer={
            <>
              <Button solid onClick={onClose} >Cancelar</Button>
              <Button solid onClick={submitForm} color="primary">Salvar</Button>
            </>
          }
        >
          <Form>
            <Row>
              <Column xs={12}>
                <FormControl label="Nome" field="business">
                  <Input type="text" name="name" placeholder="João da Silva" />
                </FormControl>
              </Column>

              <Column xs={12}>
                <FormControl label="E-mail" field="email">
                  <Input type="text" name="email" placeholder="joao@silva.com" />
                </FormControl>
              </Column>

              <Column xs={12}>
                <FormControl label="Senha" field="password">
                  <Input type="password" name="password" placeholder="1234" />
                </FormControl>
              </Column>

              <Column xs={12}>
                <FormControl label="Conf. Senha" field="password_confirmation">
                  <Input type="password" name="password_confirmation" placeholder="1234" />
                </FormControl>
              </Column>
            </Row>
          </Form>
        </Modal >
      )}
    </Formik>
  );
};

export default CustomerForm;
