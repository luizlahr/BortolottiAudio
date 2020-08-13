import React, { useCallback } from 'react';
import { FiMail, FiLock } from 'react-icons/fi';
import { Link } from 'react-router-dom';
import Form from 'formik-antd/es/form';
import 'formik-antd/es/form/style';
import { Formik } from 'formik';
import theme from 'styles/theme';

import { Container, Banner, FormWrapper } from './styles';
import Input from 'components/Form/Input';
import Button from 'components/Button';
import logoImage from 'assets/logo.svg';

const ForgotPassword: React.FC = () => {
  const handleSubmit = useCallback(async (data: object): Promise<void> => {},
  []);

  return (
    <Container>
      <FormWrapper>
        <img src={logoImage} alt="Bortolotti Audio" className="logo" />
        <Formik
          onSubmit={(values) => {
            console.log(values);
          }}
          initialValues={{}}
          enableReinitialize
        >
          <Form>
            <Input
              prefix={<FiMail color={theme.textLight} />}
              name="e-mail"
              placeholder="Informe seu e-mail cadastrado"
              type="email"
              autoComplete="email"
              autoFocus={true}
            />
            <Button
              block
              solid
              color="primary"
              type="submit"
              style={{ marginTop: '16px' }}
            >
              Entrar
            </Button>
            <Link to="/">Voltar ao Login</Link>
          </Form>
        </Formik>
      </FormWrapper>
      <Banner />
    </Container>
    //Todo
  );
};

export default ForgotPassword;
