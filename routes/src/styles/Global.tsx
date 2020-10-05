import { createGlobalStyle } from "styled-components";

import theme from "./theme";

const GlobalStyle = createGlobalStyle`
  *, p {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: 0;
  }

  html{
    height: 100%;
    min-height: 100%;
    overflow: hidden;
  }

  body, #root  {
    height: 100%;
    min-height: 100%;
    overflow: hidden;
  }

  body {
    background: ${(props) => theme.light};
    color: ${(props) => theme.textDark};
    -webkit-font-smoothing: antialiased;
    min-height: 100%;
  }

  body, input, textarea, button {
    font-family: 'Open Sans', sans-serif;
    font-size: 17px;
  }

  #root {
    position: relative;
  }

  #modal-root {
    position: absolute;
    z-index: 1000;
  }

  h1, h2,h3, h4,h5,h6, strong {
    font-weight: 500;
  }

  h1, h2,h3, h4,h5,h6 {
    font-family: Roboto, sans-serif;
    font-weight: 600;
  }

  button {
    cursor: pointer;
  }

  .ant-modal-confirm-btns {
    .ant-btn {
      border-radius: 10px;
    }
  }

  input:-webkit-autofill,
  input:-webkit-autofill:hover,
  input:-internal-autofill-selected, 
  input:-webkit-autofill:focus,
  textarea:-webkit-autofill,
  textarea:-webkit-autofill:hover,
  textarea:-webkit-autofill:focus,
  textarea:-internal-autofill-selected, 
  select:-webkit-autofill,
  select:-webkit-autofill:hover,
  select:-webkit-autofill:focus,
  select:-internal-autofill-selected {
    border: 1px solid inherit;
    -webkit-text-fill-color: inherit;
    -webkit-box-shadow: 0 0 0px 5000x transparent inset;
    box-shadow: 0 0 0px 5000x transparent inset;
    transition: background-color 5000s ease-in-out 0s;
    font-size: 17px;
  }
`;

export default GlobalStyle;
