import React from 'react';
import Sidebar from 'pages/layout/__partials/Sidebar';

import { Container, Content, Overlay } from './styles';
import { useMenu } from 'hooks/menu.hook';
import Base from '../Base';

const Main: React.FC = ({ children }) => {
  const { showMenu, toggleMenu } = useMenu();

  return (
    <Base>
      <Container className="ll-main">
        <Sidebar />
        <Content menuOpen={showMenu}>{children}</Content>
        <Overlay show={showMenu} onClick={() => toggleMenu(false)} />
      </Container>
    </Base>
  );
};

export default Main;
