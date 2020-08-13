import React from 'react';
import Modal from '../../../components/Modal'
import Input from '../../../components/Form/Input';
import Row from '../../../components/Row';
import Column from '../../../components/Column';
import FormControl from '../../../components/Form/FormControl';
import FormDivider from '../../../components/Form/FormDivider';
import Radio from '../../../components/Form/Radio';
import { useWindowWidth } from '@react-hook/window-size'
import Button from '../../../components/Button';
import Form from 'formik-antd/es/form';
import 'formik-antd/es/form/style';
import { Formik } from 'formik'

interface ICategorieForm {
  visible: boolean;
  onClose(): void;
}

const CategorieForm: React.FC<ICategorieForm> = ({ visible, onClose }) => {
  const size = useWindowWidth();

  const handleSubmit = (data: object) => {
    console.log(data);
  }

  return (
    <Formik onSubmit={(values) => { console.log(values) }} initialValues={{ business: false }} enableReinitialize>
      {({ submitForm }) => (
        <Modal
          visible={visible}
          title="Nova Categoria"
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
                <FormControl label="Categoria" field="name">
                  <Input type="text" name="name" placeholder="Guitarra" />
                </FormControl>
              </Column>
            </Row>
          </Form>
        </Modal >
      )}
    </Formik>
  );
};

export default CategorieForm;
