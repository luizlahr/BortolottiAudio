import styled, { css } from 'styled-components';
import { shade } from 'polished'
import theme from '../../../styles/theme'

interface InputProps {
  hasFocus: boolean;
  isChecked: boolean;
  size?: 'small' | 'regular' | 'large';
}

const containerSizes = {
  small: '25px',
  regular: '32px',
  large: '45px',
}

const sizes = {
  small: '20px',
  regular: '20px',
  large: '30px',
};

export const Container = styled.div<InputProps>`
  display: flex;
  align-items: center;
  height: ${props => containerSizes[props.size || 'regular']};

  .ll-checkbox {
    position:relative;
    display:flex;

    .ll-checkbox-box {
      display: flex;
      justify-content: center;
      align-items: center;
      height: ${props => sizes[props.size || 'regular']};
      width: ${props => sizes[props.size || 'regular']};
      border: 2px solid ${ props => props.theme.primary};
      border-radius: 50%;

      ${props => props.hasFocus === true && css`
        border-color: ${shade(0.4, props.theme.primary)};
      `}

      .ll-checkbox-check {
        display: flex;
        width: 10px;
        height: 10px;
        background-color: ${props => props.theme.primary};
        border-radius: 50%;

        ${props => !props.isChecked && css`
          opacity: 0;
        `}

        transition: opacity 0.3s;
      }
    }

    input {
      opacity: 0;
      position: absolute;
      top: 0;
      left: 0
    }

    .ll-checkbox-text {
      margin: 0 16px 0 8px;
    }
  }

`;
