import React from 'react';
import { MenuProvider } from './menu';
import { AuthProvider } from './auth';
import { LoaderProvider } from './loader';
// import { ConfirmProvider } from './confirm.hook';

const AppProvider: React.FC = ({ children }) => {
  return (
    <AuthProvider>
      <LoaderProvider>
        <MenuProvider>{children}</MenuProvider>
      </LoaderProvider>
    </AuthProvider>
  );
};

export default AppProvider;
