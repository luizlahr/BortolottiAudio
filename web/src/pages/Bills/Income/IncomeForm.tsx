import React from 'react';
import { useWindowWidth } from '@react-hook/window-size'
import { Formik } from 'formik'
import Form from 'formik-antd/es/form';
import 'formik-antd/es/form/style';

import Modal from 'components/Modal'
import Input from 'components/Form/Input';
import Select from 'components/Form/Select';
import Row from 'components/Row';
import Column from 'components/Column';
import FormControl from 'components/Form/FormControl';
import Button from 'components/Button';

interface IIncomeForm {
  visible: boolean;
  onClose(): void;
}

const IncomeForm: React.FC<IIncomeForm> = ({ visible, onClose }) => {
  const size = useWindowWidth();

  const handleSubmit = (data: object) => {
    console.log(data);
  }

  return (
    <Formik onSubmit={handleSubmit} initialValues={{ business: false }} enableReinitialize>
      {({ submitForm }) => (
        <Modal
          visible={visible}
          title="Nova Conta a Receber"
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
              <Column xs={8}>
                <FormControl label="Categoria" field="category_id">
                  <Select options={[{ value: 1, label: "teste" }]} name="category_id" placeholder="Selecione..." />
                </FormControl>
              </Column>
              <Column xs={8}>
                <FormControl label="Marca" field="brand_id">
                  <Select name="brand_id" placeholder="Selecione..." />
                </FormControl>
              </Column>
              <Column xs={8}>
                <FormControl label="Modelo" field="name">
                  <Input type="text" name="name" placeholder="XP-TO" />
                </FormControl>
              </Column>
            </Row>
          </Form>
        </Modal >
      )}
    </Formik>
  );
};

export default IncomeForm;
