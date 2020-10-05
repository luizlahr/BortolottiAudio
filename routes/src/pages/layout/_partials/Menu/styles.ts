import styled, { css } from 'styled-components';
import { lighten, darken } from 'polished';

interface iAside {
  show: boolean;
}

export const Container = styled.aside<iAside>`
  position: relative;
  display: flex;

  width: 280px;
  background-color: transparent;
  
  margin-left: -280px;
  transform: translateX(40px);

  overflow: hidden;
  z-index: ${props => props.theme.zMenu};
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

  width:100%;
  margin: 24px 0 40px;

  font-size: 28px;
  color: ${props => props.theme.primary};
`;

export const Item = styled.li`
  display: flex;

  line-height: 40px;
  padding: 0 24px;

  a { 
    display: flex;
    flex: 1;
    text-decoration: none;
    color: ${props => darken(0.02, props.theme.textLight)};
  }

  &:hover {
    a { 
      color: ${props => props.theme.primary};
    }
  }
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
    transition: transform 0.3s linear;
  }

  &:hover {
    background-color: rgba(0,0,0,0.07);
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