import { createGlobalStyle } from 'styled-components';

import theme from './theme';

export default createGlobalStyle`
  *, p {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: 0;
  }

  html{
    height: 100%;
    min-height: 100%;
  }

  body, #root  {
    height: 100%;
    min-height: 100%;
  }

  body {
    background: ${(props) => theme.light};
    color: ${(props) => theme.textDark};
    -webkit-font-smoothing: antialiased;
    min-height: 100%;
  }

  body, input, textarea, button {
    font-family: Ubuntu, sans-serif;
    font-size: 15px;
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

  button {
    cursor: pointer;
  }

  .ant-modal-confirm-btns {
    .ant-btn {
      border-radius: 10px;
    }
  }


`;
