import styled, { css, createGlobalStyle } from 'styled-components';
import theme from '../../../styles/theme';

interface IInput {
  hasFocus: boolean;
  isDirty: boolean;
  width?: number | string;
}

const inputBases = css<IInput>`
    padding: 4px 8px;
    overflow: hidden;

    border-radius: 10px;
    border: 2px solid transparent;

    background-color: ${theme.secondary};
    height: ${theme.inputSizes.regular};

    &::placeholder{
      color: ${theme.textPlaceholder};
    }
`;

const inputFocused = css`
  border-color: ${theme.primary} !important;
  border-right-width: 2px !important;
  box-shadow: none;
`;

export const SearchStyles = createGlobalStyle`
  .ant-input-affix-wrapper {
    display: flex;
    width: ${props => props.width}px;

    ${inputBases}

    .ant-input-prefix {
      color: ${theme.textPlaceholder};
    }

    &.ant-input-affix-wrapper-focused {
      ${inputFocused}

      .ant-input-prefix {
        color: ${theme.primary};
      }
    }

    &:hover {
      border-color: transparent;
    }

    input.ant-input {
      display: flex;
      align-items: center;
      height: 100%;
      border-color:transparent;

      background-color: transparent;
    }
  };

  ${props => props.isDirty && css`
    .ant-input-affix-wrapper .ant-input-prefix {
        color: ${theme.primary} !important;
    }
  `};
`;
