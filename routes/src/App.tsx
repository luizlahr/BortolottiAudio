import React from 'react';
import { BrowserRouter as Router } from 'react-router-dom';

import Routes from 'routes';
import GlobalStyle from 'styles/Global';
import theme from 'styles/theme';
import { ThemeProvider } from 'styled-components';
import AppProvider from 'hooks';
import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

function App() {
  return (
    <Router>
      <ThemeProvider theme={theme}>
        <AppProvider>
          <ToastContainer />
          <Routes />
          <GlobalStyle />
        </AppProvider>
      </ThemeProvider>
    </Router>
  );
}

export default App;
