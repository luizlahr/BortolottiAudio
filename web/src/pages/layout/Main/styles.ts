import styled, { css } from 'styled-components';

interface IContent {
  menuOpen: boolean;
}

interface IOverlay {
  show: boolean;
}

export const Container = styled.div`
  display: flex;
  flex: 1;
  min-height: 100%;
  justify-content: flex-start;
`;

export const Content = styled.div<IContent>`
  display: flex;
  flex: 1;
  min-height: 100%;
  transition: padding 0.4s;

  padding: 30px 50px;

  z-index: ${(props) => props.theme.zContent};
`;

export const Overlay = styled.div<IOverlay>`
  position: fixed;
  display: flex;
  height: 100%;
  top: 0;
  right: 0;
  left: 0;

  background: rgba(255, 255, 255, 0.2);
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s;

  z-index: ${(props) => props.theme.zMenuOverlay};

  ${(props) =>
    props.show &&
    css`
      opacity: 1;
      pointer-events: all;
      display: flex;
    `}

  backdrop-filter: blur(4px);
`;
