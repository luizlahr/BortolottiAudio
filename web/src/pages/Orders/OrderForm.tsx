import React from 'react';
import Modal from '../../components/Modal'
import Input from '../../components/Form/Input';
import Row from '../../components/Row';
import Column from '../../components/Column';
import FormControl from '../../components/Form/FormControl';
import FormDivider from '../../components/Form/FormDivider';
import Radio from '../../components/Form/Radio';
import { useWindowWidth } from '@react-hook/window-size'
import Button from '../../components/Button';
import Form from 'formik-antd/es/form';
import 'formik-antd/es/form/style';
import { Formik } from 'formik'

// import {Container} from './styles';

interface ICustomerForm {
  visible: boolean;
  onClose(): void;
}

const CustomerForm: React.FC<ICustomerForm> = ({ visible, onClose }) => {
  const size = useWindowWidth();

  const handleSubmit = (data: object) => {
    console.log(data);
  }

  const businessOptions = [
    { value: false, label: "Física" },
    { value: true, label: "Jurídica" },
  ]

  return (
    <Formik onSubmit={(values) => { console.log(values) }} initialValues={{ business: false }} enableReinitialize>
      {({ submitForm }) => (
        <Modal
          visible={visible}
          title="Nova Ordem"
          onClose={onClose}
          color="primary"
          width={size <= 1024 ? "100%" : "80%"}
          footer={
            <>
              <Button solid onClick={onClose} >Cancelar</Button>
              <Button solid onClick={submitForm} color="primary">Salvar</Button>
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
                  <Radio name="business"
                    options={businessOptions}
                  />
                </FormControl>
              </Column>
              <Column xs={18}>
                <FormControl label="Pessoa" field="business">
                  <Input type="text" name="name" placeholder="João da Silva" />
                </FormControl>
              </Column>

              <Column xs={12}>
                <FormControl label="Apelido" field="nickname">
                  <Input type="text" name="nickname" placeholder="Joãozinho" />
                </FormControl>
              </Column>
              <Column xs={12}>
                <FormControl label="E-mail" field="email">
                  <Input type="text" name="email" placeholder="joao@silva.com" />
                </FormControl>
              </Column>

              <Column xs={12}>
                <FormControl label="Telefone" field="phone">
                  <Input type="text" name="phone" placeholder="(19) 9 3535-5555" />
                </FormControl>
              </Column>
              <Column xs={12}>
                <FormControl label="Celular" field="mobile">
                  <Input type="text" name="mobile" placeholder="(19) 9 9999-9999" />
                </FormControl>
              </Column>

              <Column xs={12}>
                <FormControl label="RG" field="rg">
                  <Input type="text" name="rg" placeholder="9.999.999-X" />
                </FormControl>
              </Column>
              <Column xs={12}>
                <FormControl label="CPF" field="cpf">
                  <Input type="text" name="cpf" placeholder="999.999.999-99" />
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
                  <Input type="text" name="neighborhood" placeholder="Centro" />
                </FormControl>
              </Column>

              <Column xs={20}>
                <FormControl label="Endereço" field="address">
                  <Input type="text" name="address" placeholder="Rua João da Silva" />
                </FormControl>
              </Column>

              <Column xs={4}>
                <FormControl label="Número" field="number">
                  <Input type="text" name="number" placeholder="1234" />
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
