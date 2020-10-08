import styled, { css } from 'styled-components';

interface ISidebar {
  show: boolean;
}

export const Container = styled.aside<ISidebar>`
  position: relative;
  display: flex;

  width: 250px;
  margin-left: -250px;
  min-height: 100%;

  z-index: ${(props) => props.theme.zMenu};

  transform: translateX(30px);
  transition: transform 0.3s, background 0.3s 0.3s;

  background-color: ${(props) => props.theme.light};

  ${(props) =>
    props.show &&
    css`
      transform: translateX(250px);
      background-color: ${(props) => props.theme.secondary};
      transition: transform 0.3s, background 0.3s 0.3s;
    `}
`;

export const Nav = styled.nav`
  display: flex;
  flex-direction: column;

  padding: 30px;
  width: 100%;
  min-height: 100%;
  top: 0;
`;

export const MenuToggler = styled.div<ISidebar>`
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;

  width: 30px;
  right: 0;
  top: 0;
  bottom: 0;

  cursor: pointer;

  background-color: transparent;
  transition: background 0.3s, color 0.3s;
  color: ${(props) => props.theme.textLight};

  svg {
    transition: transform 0.4s;
    ${(props) =>
    props.show &&
    css`
        transform: rotate(180deg);
      `};
  }

  &:hover {
    background: rgba(0, 0, 0, 0.05);
    color: ${(props) => props.theme.textDark};
  }
`;
