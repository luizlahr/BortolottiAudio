import styled, { css } from 'styled-components';

interface iContainer {
  show: boolean;
}

export const Container = styled.div<iContainer>`
  position: absolute;
  display: flex;
  bottom: 0;
  top: 0;
  right: 0;
  left: 0;

  opacity: 0;
  transition: opacity 0.2s linear;

  /* background: ${props => props.theme.overlayColor}; */
  background: rgba(255,255,255,0.3);
  backdrop-filter: blur(4px);
  z-index: ${props => props.theme.zMenuOverlay};

  ${props => props.show && css`
    opacity: 1;
  `}
`;
