import React, { useCallback } from 'react';
import { ChevronLeft } from 'react-feather';
import { Link } from 'react-router-dom';

import { Container, Trigger, Nav, UserProfile, Item, Logo } from './styles';
import profile from 'assets/profile_img.jpg';
import { useMenu } from 'hooks/menu';

function Menu() {
  const { menuOn, showMenu, hideMenu } = useMenu();

  const toggleMenu = useCallback(() => {
    if (menuOn) {
      hideMenu();
    } else {
      showMenu();
    }
  }, [menuOn, showMenu, hideMenu]);

  return (
    <Container show={menuOn}>
      <>
        <Trigger show={menuOn} onClick={toggleMenu}>
          <ChevronLeft />
        </Trigger>
        <Nav>
          <Logo>BortolottiAudio</Logo>
          <UserProfile>
            <img src={profile} alt="Usuário" />
            <p>Administrador</p>
          </UserProfile>
          <ul>
            <Item>
              <Link to="/">Painel</Link>
            </Item>
            <Item>
              <Link to="/">Clientes</Link>
            </Item>
            <Item>
              <Link to="/">Equipamentos</Link>
            </Item>
            <Item>
              <Link to="/">Ordens</Link>
            </Item>
            <Item>
              <Link to="/">Fluxo</Link>
            </Item>
            <Item>
              <Link to="/">Contas</Link>
            </Item>
            <Item>
              <Link to="/">Contábil</Link>
            </Item>
            <Item>
              <Link to="/">Configurações</Link>
            </Item>
          </ul>
        </Nav>
      </>
    </Container>
  );
}

export default Menu;
