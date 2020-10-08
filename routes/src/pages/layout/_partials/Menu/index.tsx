import React, { useCallback } from 'react';
import { ChevronDown, ChevronLeft } from 'react-feather';
import { Link } from 'react-router-dom';

import {
  Container,
  Trigger,
  Nav,
  UserProfile,
  Item,
  SubMenu,
  Logo,
} from './styles';
import profile from 'assets/profile_img.jpg';
import { useMenu } from 'hooks/menu';

function Menu() {
  const { menuOn, showMenu, hideMenu, openMenu, handleOpenMenu } = useMenu();

  const toggleMenu = useCallback(() => {
    if (menuOn) {
      hideMenu();
    } else {
      showMenu();
    }
  }, [menuOn, showMenu, hideMenu]);

  const isMenuOpen = (menu: string): boolean => {
    return openMenu === menu;
  };

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
            <SubMenu
              onClick={() => handleOpenMenu('people')}
              open={isMenuOpen('people')}
            >
              <span>
                Cadastros
                <ChevronDown />
              </span>
              <ul>
                <Item>
                  <Link to="/people/customers">Clientes</Link>
                </Item>
                <Item>
                  <Link to="/">Fornecedores</Link>
                </Item>
              </ul>
            </SubMenu>
            <SubMenu
              onClick={() => handleOpenMenu('equipments')}
              open={isMenuOpen('equipments')}
            >
              <span>
                Equipamentos
                <ChevronDown />
              </span>
              <ul>
                <Item>
                  <Link to="/">Categoria</Link>
                </Item>
                <Item>
                  <Link to="/">Marca</Link>
                </Item>
                <Item>
                  <Link to="/">Modelo</Link>
                </Item>
              </ul>
            </SubMenu>
            <Item>
              <Link to="/">Ordens</Link>
            </Item>
            <Item>
              <Link to="/">Fluxo</Link>
            </Item>
            <SubMenu
              onClick={() => handleOpenMenu('bills')}
              open={isMenuOpen('bills')}
            >
              <span>Contas</span>
              <ul>
                <Item>
                  <Link to="/">a Pagar</Link>
                </Item>
                <Item>
                  <Link to="/">a Receber</Link>
                </Item>
                <Item>
                  <Link to="/">Categoria</Link>
                </Item>
              </ul>
            </SubMenu>
            <SubMenu
              onClick={() => handleOpenMenu('accounting')}
              open={isMenuOpen('accounting')}
            >
              <span>
                Contábil
                <ChevronDown />
              </span>
              <ul>
                <Item>
                  <Link to="/">Movimentações</Link>
                </Item>
                <Item>
                  <Link to="/">Contas Bancárias</Link>
                </Item>
              </ul>
            </SubMenu>
            <SubMenu
              onClick={() => handleOpenMenu('settings')}
              open={isMenuOpen('settings')}
            >
              <span>
                Configurações
                <ChevronDown />
              </span>
              <ul>
                <Item>
                  <Link to="/">Usuários</Link>
                </Item>
              </ul>
            </SubMenu>
          </ul>
        </Nav>
      </>
    </Container>
  );
}

export default Menu;
