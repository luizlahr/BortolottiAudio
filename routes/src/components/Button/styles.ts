import styled, { css, keyframes } from 'styled-components';
import { darken } from 'polished'

interface iButton {
  loading: 1 | 0;
  color: 'default' | 'primary';
}

const colors = {
  default: css`
    background-color: ${props => props.theme.secondary};
    border-color: ${props => props.theme.secondary};
    color: ${props => props.theme.textDark};

    &:hover {
      background-color: ${props => darken(0.1, props.theme.secondary)}
    }

    & > span.btn-loading svg {
      color: ${props => props.theme.light}; 
    }
  `,
  primary: css`
    background-color: ${props => props.theme.primary};
    border-color: ${props => props.theme.primary};
    color: ${props => props.theme.light};

    &:hover {
      background-color: ${props => darken(0.1, props.theme.primary)}
    }

    & > span.btn-loading svg {
      color: ${props => props.theme.light}; 
    }
  `,
}

const rotate = keyframes`
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
`;

export const Container = styled.button<iButton>`
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;

  padding: 0 16px;

  height: 40px;
  border: 1px solid #ccc;
  background-color: ${props => props.theme.secondary};
  border-radius: ${props => props.theme.radiusLarge};
  font-size: ${props => props.theme.fontSizeButton};

  opacity: 1;
  transition: background-color 0.3s ease;

  &:hover {
    background-color: ${props => darken(0.2, props.theme.secondary)}
  }

  .btn-content {
    font-size:inherit;
  }

  & > span.btn-loading {
    position: absolute;
    display: flex;
    flex: 1;
    justify-content: center;
    align-items: center;
    opacity: 0;

    svg {
      height: 20px;
      width: 20px;
      animation: ${rotate} 1.5s linear infinite;
    }
  }

  ${props => props.loading === 1 && css`
    cursor: wait;

    & > span.btn-loading {
      opacity: 1;
    }

    & > span.btn-content {
      opacity: 0;
    }
  `}

  ${props => props.disabled && css`
    opacity: 0.7;
  `}

  ${props => colors[props.color]};
`;
