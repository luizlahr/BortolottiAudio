import React from 'react';
import { ThemeProvider } from 'styled-components';
import { ToastContainer } from 'react-toastify';

import Routes from 'routes';
import theme from 'styles/theme';
import GlobalStyles from 'styles/global';
// import { BrowserRouter } from 'react-router-dom';
import AppProvider from 'hooks';
import toastifyConfig from 'config/toastify';
import 'react-toastify/dist/ReactToastify.css';
import { Router } from 'react-router';
import history from 'routes/history';
import Loader from 'components/PageLoader';
import { useLoader } from 'hooks/loader.hook';

function App() {
  const { active: loaderState } = useLoader();
  return (
    <ThemeProvider theme={theme}>
      <ToastContainer {...toastifyConfig} />
      <Router history={history}>
        <AppProvider>
          <Loader show={loaderState} />
          <Routes />
          <div id="modal-root"></div>
          <GlobalStyles />
        </AppProvider>
      </Router>
    </ThemeProvider>
  );
}

export default App;
