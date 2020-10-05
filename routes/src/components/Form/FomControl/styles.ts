import styled, { css } from 'styled-components';

interface iFormControl {
  hasError: boolean;
}

export const Container = styled.div<iFormControl>`
  display: flex;
  flex-direction: column;
  margin-bottom: 12px;

  .ll-input { 
    margin: 4px 0;
  }

  span.error-msg {
    color: ${props => props.theme.danger};
    font-size: 14px;
  }

  ${props => props.hasError && css`
    .ll-input {
      border-color: ${props.theme.danger} !important
    }
  `}
`;
