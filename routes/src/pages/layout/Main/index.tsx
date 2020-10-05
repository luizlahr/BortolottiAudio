import React from 'react';

import { Container } from './styles';
import Menu from 'pages/layout/_partials/Menu';
import Overlay from 'pages/layout/_partials/Overlay';

const Main: React.FC = ({ children }) => {
  return (
    <Container>
      <Menu />
      {children}
      <Overlay />
    </Container>
  );
};

export default Main;
