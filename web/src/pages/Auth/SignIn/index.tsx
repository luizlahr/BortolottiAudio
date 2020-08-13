import React, { useCallback, useState } from 'react';
import { Formik, FormikHelpers, FormikHandlers } from 'formik';
import { FiMail, FiLock } from 'react-icons/fi';
import { Link, useHistory } from 'react-router-dom';
import Form from 'formik-antd/es/form';
import 'formik-antd/es/form/style';
import Yup from 'utils/yup';

import { Container, Banner, FormWrapper } from './styles';
import theme from 'styles/theme';
import Input from 'components/Form/Input';
import Password from 'components/Form/Password';
import Button from 'components/Button';
import logoImage from 'assets/logo.svg';
import { useAuth } from 'hooks/auth.hook';
import FormControl from 'components/Form/FormControl';
import handler from 'exceptions/handler';

interface ICredentials {
  email: string;
  password: string;
}

const initialValues: ICredentials = {
  email: '',
  password: '',
};

const signInSchema = Yup.object().shape({
  email: Yup.string().required().email(),
  password: Yup.string().required(),
});

const SignIn: React.FC = () => {
  const [loading, setLoading] = useState<boolean>(false);
  const { signIn } = useAuth();
  const history = useHistory();

  const handleSubmit = async (
    credentials: ICredentials,
    { setErrors }: any,
  ): Promise<void> => {
    setLoading(true);
    try {
      await signInSchema.validate(credentials, {
        abortEarly: false,
      });

      await signIn(credentials, setErrors);
      history.push('/');
    } catch (exception) {
      const params = {
        setter: setErrors,
      };
      handler({ exception, params });
    }
    setLoading(false);
  };

  return (
    <Container>
      <FormWrapper>
        <img src={logoImage} alt="Bortolotti Audio" className="logo" />
        <Formik
          onSubmit={handleSubmit}
          initialValues={initialValues}
          enableReinitialize
        >
          {({ errors }) => (
            <Form>
              <FormControl field="email" error={errors.email}>
                <Input
                  prefix={<FiMail color={theme.textLight} />}
                  name="email"
                  placeholder="E-mail"
                  autoComplete="email"
                  autoFocus={true}
                />
              </FormControl>
              <FormControl field="password" error={errors.password}>
                <Password
                  type="password"
                  prefix={<FiLock color={theme.textLight} />}
                  name="password"
                  autoComplete="none"
                  placeholder="Senha"
                />
              </FormControl>
              <Button
                block
                solid
                loading={loading}
                showLoading={loading}
                color="primary"
                type="submit"
                style={{ marginTop: '16px' }}
              >
                Entrar
              </Button>
              <Link to="/">Esqueci minha senha</Link>
            </Form>
          )}
        </Formik>
      </FormWrapper>
      <Banner />
    </Container>
  );
};

export default SignIn;
