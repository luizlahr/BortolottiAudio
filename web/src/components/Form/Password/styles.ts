import { useCallback } from 'react';
import styled, { createGlobalStyle, css } from 'styled-components';
import theme from '../../../styles/theme';

interface IInput {
  hasFocus: boolean;
  isDirty: boolean;
}

const inputBases = css<IInput>`
  padding: 4px 8px;
  overflow: hidden;

  border-radius: 10px;
  border: 2px solid transparent;

  background-color: ${theme.secondary};
  height: ${theme.inputSizes.regular};

  &::placeholder {
    color: ${theme.textPlaceholder};
  }
`;

const inputFocused = css`
  border-color: ${theme.primary} !important;
  border-right-width: 2px !important;
  box-shadow: none;
`;

export const InputStyles = createGlobalStyle`
  .ll-input {
    border-radius: 10px;
  }
`;
