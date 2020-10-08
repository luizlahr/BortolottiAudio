import React from 'react';

import { Container } from './styles';
import Menu from 'pages/layout/_partials/Menu';
import Overlay from 'pages/layout/_partials/Overlay';
import Loader from 'components/Loader';

const Main: React.FC = ({ children }) => {
  return (
    <Container>
      <>
        <Loader />
        <Menu />
        {children}
        <Overlay />
      </>
    </Container>
  );
};

export default Main;
