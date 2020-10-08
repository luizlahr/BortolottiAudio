import styled, { css } from 'styled-components';

interface InputInterface {
  focus: boolean;
}

export const Container = styled.div<InputInterface>`
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 4px 16px;
  border: 1px solid #ddd;
  border-radius: 4px;
  height: 40px;

  ${(props) =>
    props.focus &&
    css`
      border-width: 2px;
      border-color: ${(props) => props.theme.primary};
    `}

  input {
    display: flex;
    flex: 1;
    height: 100%;
    font-size: 17px;
    border: 0;
    padding: 0;

    &.ant-input:focus,
    ˆ.ant-input-focused {
      box-shadow: none;
    }
  }

  .password-sufix {
    display: flex;
    align-items: center;
    margin-left: 8px;

    svg {
      width: 20px;
      height: 20px;
      color: ${(props) => props.theme.terciary};
    }
  }
`;
