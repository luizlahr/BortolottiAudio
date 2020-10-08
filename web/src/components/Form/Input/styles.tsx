import styled, { css } from 'styled-components';

interface iInput {
  focus?: boolean;
}

export const Container = styled.div<iInput>`
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 4px 16px;
  height: 40px;
  transition: border-color 0.4s ease;

  ${(props) =>
    props.focus &&
    css`
      border-width: 2px;
      border-color: ${(props) => props.theme.primary};
    `}

  input {
    height: 100%;
    border: none;
    font-size: 17px;
    padding: 0;

    &:focus {
      box-shadow: none;
    }
  }
`;
