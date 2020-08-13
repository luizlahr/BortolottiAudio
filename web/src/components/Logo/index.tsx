import React from 'react';

import { Container } from './styles';
import logo from '../../assets/logo.svg';

const Logo: React.FC = () => {
  return (
    <Container to="/home">
      <img src={logo} alt="Bortolotti Audio" />
    </Container>
  );
};

export default Logo;
