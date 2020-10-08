import styled, { css } from 'styled-components';
import { lighten, darken } from 'polished';

interface iAside {
  show: boolean;
}

interface iSubMenu {
  open: boolean;
}

export const Container = styled.aside<iAside>`
  position: relative;
  display: flex;
  
  z-index: ${props => props.theme.zMenu};
  overflow: hidden;
  
  width: 280px;
  min-width: 280px;
  background-color: transparent;

  padding: 0;
  margin-left: -280px;
  transform: translateX(40px);

  transition: transform 0.2s linear, background 0.2s 0.2s linear;

  ${props => props.show && css`
    background-color: ${props => lighten(0.1, props.theme.secondary)};
    transform: translateX(280px);
    transition: transform 0.2s linear, background 0.2s linear;
  `}
`;

export const Nav = styled.nav`
  display: flex;
  flex-direction: column;

  width: 100%;
  padding: 0 0 40px; 
  overflow-y: auto;
`;

export const Logo = styled.h1`
  display: flex;
  justify-content: center;
  
  margin: 24px 32px 40px;

  font-size: 28px;
  color: ${props => props.theme.primary};
`;

export const Item = styled.li`
  display: flex;
  flex-direction: column;
  
  z-index: 11;

  background-color: inherit;

  >a { 
    display: flex;
    flex: 1;
    text-decoration: none;
    color: ${props => darken(0.02, props.theme.textLight)};
    
    padding: 8px 32px;

    &:hover {
        color: ${props => props.theme.primary};
    }
  }
`;

export const SubMenu = styled.li<iSubMenu>`
  display: flex;
  flex-direction: column; 

  z-index: 10;

  &>span {
    display: flex;
    flex: 1;
    justify-content: space-between;
    align-items: center;

    cursor: pointer;

    padding: 8px 32px;
    text-decoration: none;
    color: ${props => darken(0.02, props.theme.textLight)};

    svg {
      display: flex;
      width: 20px;
      height: 20px;
      margin-right: 20px;
      transform: rotate(180deg);
      transition: transform 0.3s ease;
    }
    
    &:hover {
        color: ${props => props.theme.primary};
    }
  }

  &>ul {
    display: flex;
    flex-direction: column;
    
    opacity: 1;
    max-height: 10em;

    padding: 8px 24px;

    li:last-child {
      padding-bottom: 0;
    }

    transition: max-height 0.3s linear, opacity 0.1s 0.3s linear, padding 0.2s linear;
  }


  ${props => !props.open && css`
    &>span {
      svg {
        transform: rotate(0deg);
      }
    }
    &>ul {
      overflow: hidden;
      opacity: 0;
      max-height: 0;
      padding: 0;

      transition: max-height 0.3s linear, opacity 0.3s 0.3s linear, padding 0.3s 0.3s linear;
    }
  `}
`;

export const UserProfile = styled.section`
  display: flex;
  flex-direction: column;

  align-items: center;
  margin: 0 0 40px;

  img { 
    height: 64px;
    width: 64px;
    border-radius: 50%;
    margin: 0 0 16px;
  }
`;

export const Trigger = styled.button<iAside>`
  position: absolute;
  right: 0;
  display: flex;

  justify-content: center;
  align-items: center;

  height: 100%;
  width: 40px;

  background: transparent;
  border: 0;
  transition: background 0.3s linear;

  svg {
    color: ${props => props.theme.terciary};
    opacity: 0.5;
    transition: all 0.3s linear;
  }

  &:hover {
    /* background-image: linear-gradient(to right, transparent, rgba(0,0,0,0.07)); */
    background-color: rgba(0,0,0,0.07);
    svg {
      opacity: 1;
    }
  }

  ${props => !props.show && css`
    opacity:0;
    transition: opacity 0.3s linear;

    svg {
      transform: rotate(180deg);
    }

    &:hover{
      opacity: 1;
    }
  `}
`;