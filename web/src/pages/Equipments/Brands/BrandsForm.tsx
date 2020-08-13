import React from 'react';
import { useWindowWidth } from '@react-hook/window-size'
import { Formik } from 'formik'
import Form from 'formik-antd/es/form';
import 'formik-antd/es/form/style';

import Modal from 'components/Modal'
import Input from 'components/Form/Input';
import Row from 'components/Row';
import Column from 'components/Column';
import FormControl from 'components/Form/FormControl';
import Button from 'components/Button';

interface IBrandsForm {
  visible: boolean;
  onClose(): void;
}

const BrandsForm: React.FC<IBrandsForm> = ({ visible, onClose }) => {
  const size = useWindowWidth();

  const handleSubmit = (data: object) => {
    console.log(data);
  }

  return (
    <Formik onSubmit={(values) => { console.log(values) }} initialValues={{ business: false }} enableReinitialize>
      {({ submitForm }) => (
        <Modal
          visible={visible}
          title="Nova Marca"
          onClose={onClose}
          color="primary"
          width={size <= 1024 ? "100%" : "50%"}
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
                <FormControl label="Marca" field="name">
                  <Input type="text" name="name" placeholder="Bortolotti Audio" />
                </FormControl>
              </Column>
            </Row>
          </Form>
        </Modal >
      )}
    </Formik>
  );
};

export default BrandsForm;
