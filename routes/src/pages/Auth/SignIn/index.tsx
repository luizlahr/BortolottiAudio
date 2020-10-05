import React, { useCallback, useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useForm, Controller } from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers';
import Yup from 'utils/yup';
import { useAuth } from 'hooks/auth';

import {
  Container,
  UserContent,
  UserImage,
  Logo,
  SingInContent,
  SignInActions,
} from './styles';
import FormControl from 'components/Form/FomControl';
import Password from 'components/Form/Password';
import Email from 'components/Form/Email';
import Button from 'components/Button';

interface iCredentials {
  email: string;
  password: string;
}

const signInSchema = Yup.object().shape({
  email: Yup.string().email().required(),
  password: Yup.string().required(),
});

export default function Login() {
  const { signUserIn } = useAuth();
  const navigate = useNavigate();
  const [loading, setLoading] = useState<boolean>(false);

  const { handleSubmit, control, setError, clearErrors, errors } = useForm<
    iCredentials
  >({
    resolver: yupResolver(signInSchema),
  });

  const onSubmit = useCallback(
    async (credentials: iCredentials) => {
      setLoading(true);
      clearErrors();
      await signUserIn(credentials, setError);
      navigate('/');
      setLoading(true);
    },
    [signUserIn, clearErrors, navigate, setError],
  );

  return (
    <Container>
      <UserContent>
        <header>
          <Logo>Bortolotti Audio</Logo>
        </header>

        <SingInContent>
          <h2>Autenticação</h2>
          <form onSubmit={handleSubmit(onSubmit)}>
            <FormControl label="E-mail" error={errors?.email?.message}>
              <Controller
                name="email"
                autoFocus
                control={control}
                as={Email}
                defaultValue=""
              />
            </FormControl>

            <FormControl label="Senha" error={errors?.password?.message}>
              <Controller
                name="password"
                control={control}
                as={Password}
                defaultValue=""
              />
            </FormControl>

            <SignInActions>
              <Link to="/">Esqueceu sua senha?</Link>
              <Button role="submit" color="primary" loading={loading}>
                Entrar
              </Button>
            </SignInActions>
          </form>
        </SingInContent>

        <footer>
          <span>&copy; Todos os direitos reservados</span>
        </footer>
      </UserContent>
      <UserImage></UserImage>
    </Container>
  );
}
