import styled, { css } from 'styled-components';
import { transparentize } from 'polished';

interface FormControlProps {
  hasError: boolean;
}

export const Container = styled.div<FormControlProps>`
  display: flex;
  flex: 1;
  flex-direction: column;

  .ll-input {
    width: 100%;
  }

  label {
    color: ${(props) => props.theme.textSelected};
    padding-left: 2px;
    margin-bottom: 4px;
  }

  ${(props) =>
    props.hasError &&
    css`
      label {
        color: ${(props) => props.theme.danger};
      }

      .ll-input {
        color: ${(props) => props.theme.danger} !important;
        box-shadow: 0 0 0 2px
          ${(props) => transparentize(0.8, props.theme.danger)} !important;
        border-color: ${(props) => props.theme.danger} !important;
      }
    `}
`;

export const Error = styled.div`
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  font-size: 13px;

  color: ${(props) => props.theme.danger};
`;
