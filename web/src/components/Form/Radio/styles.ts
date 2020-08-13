import styled, { css } from 'styled-components';
import theme from '../../../styles/theme'

interface IRadioGroup {
  size?: "small" | "regular" | "large";
}

interface IRadio {
  isChecked: number;
}

const sizes = {
  small: theme.inputSizes.small,
  regular: theme.inputSizes.regular,
  large: theme.inputSizes.large,
}

export const RadioGroup = styled.div<IRadioGroup>`
  display: flex;
  align-items: center;
  height: ${props => sizes[props.size || "regular"]};

label.ll-radiogroup {
  position: relative;
  display: flex;
  margin-right: 8px;
}

input {
  position: absolute;
  opacity: 0;
}
`;

export const RadioContainer = styled.span<IRadio>`
display: flex;
justify-content: center;
align-items: center;
height: 20px;
width: 20px;

border: 2px solid ${ props => props.theme.primary};
border-radius: 50%;

margin-right: 4px;

  &::before {
  content: '';
  display: flex;
  height: 10px;
  width: 10px;
  background-color: ${ props => props.theme.primary};
  border-radius: 50%;

  transition: opacity 0.3s;
}

${
  props => !props.isChecked && css`
    &::before {
      opacity: 0;
    }
  `}
`;
