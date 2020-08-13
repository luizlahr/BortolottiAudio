import React from 'react';
import { Link } from 'react-router-dom';

import { Container } from './styles';
import Button from 'components/Button';
import background from 'assets/bg404.png';

const NotFoundPage: React.FC = () => {
  return (
    <Container>
      <h2>Oops...</h2>
      <img src={background} alt="404 - Not Found Page!" />
      <h3>Não encontramos o que esta buscando!</h3>
      <Link to="/">
        <Button>Voltar para home</Button>
      </Link>
    </Container>
  );
};

export default NotFoundPage;
