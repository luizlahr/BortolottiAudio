import React from 'react';
import { FiChevronRight } from 'react-icons/fi';

import { Container, Nav, MenuToggler } from './styles';

import Logo from 'components/Logo';
import { useMenu } from 'hooks/menu.hook';
import Menu from 'pages/layout/__partials/Menu';
import UserProfile from 'pages/layout/__partials/UserProfile';

const Sidebar: React.FC = () => {
  const { showMenu, toggleMenu } = useMenu();

  return (
    <>
      <Container show={showMenu}>
        <Nav>
          <MenuToggler show={showMenu} onClick={() => toggleMenu()}>
            <FiChevronRight />
          </MenuToggler>
          <Logo />
          <UserProfile />
          <Menu />
        </Nav>
      </Container>
    </>
  );
};

export default Sidebar;
