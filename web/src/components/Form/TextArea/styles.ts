import styled, { css } from 'styled-components';

interface ITextAreaProps {
  hasFocus: boolean;
  isDirty: boolean;
}

export const Container = styled.div<ITextAreaProps>`
  display: flex;
  flex: 1;
  align-items: flex-start;
  border-radius: 16px;
  padding: 8px 4px 8px 16px;

  background-color: ${(props) => props.theme.secondary};
  border: 2px solid ${(props) => props.theme.secondary};
  color: ${(props) => props.theme.textPlaceholder};

  ${(props) =>
    props.hasFocus &&
    css`
      border: 2px solid ${props.theme.primary};
      color: ${props.theme.primary};
    `}

  ${(props) =>
    props.isDirty &&
    css`
      color: ${props.theme.primary};
    `}

  & + div.ll-input {
    margin-top: 16px;
  }

  textarea {
    flex: 1 1;
    resize: vertical;
    background: transparent;
    border: none;
    padding-right: 12px;
    color: ${(props) => props.theme.textDark};

    &::placeholder {
      color: ${(props) => props.theme.textPlaceholder};
    }
  }

  > svg {
    margin-right: 8px;
  }
`;
