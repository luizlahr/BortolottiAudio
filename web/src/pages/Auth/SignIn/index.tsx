import React from 'react';
import { useForm, Controller } from 'react-hook-form';
import * as yup from 'yup';
import { toast } from 'react-toastify';
import { yupResolver } from '@hookform/resolvers';

import api from 'services/api';
import { Container, UserContent, UserImage, SignInBox, Logo } from './styles';
import Input from 'components/Form/Input';
import Password from 'components/Form/Password';
import FormControl from 'components/Form/FormControl';
import { Link } from 'react-router-dom';
import errorHandler from 'exceptions/handler';

type Inputs = {
  email: string;
  password: string;
};

const loginSchema = yup.object().shape({
  email: yup.string().required().email(),
  password: yup.string().required(),
});

export default function Component() {
  const { handleSubmit, errors, control } = useForm<Inputs>({
    resolver: yupResolver(loginSchema),
  });

  const onSubmit = async (values: Inputs) => {
    console.log(values);
    try {
      const { data } = await api.post('/auth', values);
      console.log(data);
    } catch (exception) {
      errorHandler({ exception });
    }
  };

  return (
    <Container>
      <UserContent>
        <header>
          <Logo>Bortolotti Audio</Logo>
        </header>
        <SignInBox>
          <h1>Autenticação</h1>
          <form autoComplete="off" onSubmit={handleSubmit(onSubmit)}>
            <FormControl label="E-mail" error={errors.email?.message}>
              <Controller
                as={Input}
                control={control}
                name="email"
                defaultValue=""
                autoFocus
                autoComplete="off"
              />
            </FormControl>
            <FormControl label="Senha" error={errors.password?.message}>
              <Controller
                as={Password}
                control={control}
                name="password"
                defaultValue=""
                type="password"
              />
            </FormControl>
            <div className="actions">
              <Link to="/">Esqueceu sua senha?</Link>
              <button type="submit">Entrar</button>
            </div>
          </form>
        </SignInBox>
        <footer>@2020 Todos os direitos reservados</footer>
      </UserContent>
      <UserImage>
        <span>
          by <Link to="http://www.unsplash.com">Unsplash</Link>
        </span>
      </UserImage>
    </Container>
  );
}
