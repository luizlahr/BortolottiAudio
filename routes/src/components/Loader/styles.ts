import styled, { keyframes, css } from 'styled-components';

const rotate = keyframes`
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
`;

interface iContainer {
  show?: boolean;
}

export const Container = styled.section<iContainer>`
  position: absolute;
  display: flex;

  justify-content: center;
  align-items: center;

  width: 100vw;
  height: 100vh;

  opacity: 0;
  pointer-events: none;

  background-color: rgba(255,255,255,0.2);
  backdrop-filter: blur(4px);

  z-index: ${props => props.theme.zLoader};

  svg {
      height: 30px;
      width: 30px;
      animation: ${rotate} 1.5s linear infinite;
    }

  ${props => props.show && css`
    opacity: 1;
    pointer-events: auto;
    cursor: wait;
  `}
`;
