import React from 'react';
import { MenuProvider } from './menu.hook';
import { AuthProvider } from './auth.hook';
import { LoaderProvider } from './loader.hook';
import { ConfirmProvider } from './confirm.hook';

const AppProvider: React.FC = ({ children }) => {
  return (
    <LoaderProvider>
      <ConfirmProvider>
        <AuthProvider>
          <MenuProvider>{children}</MenuProvider>
        </AuthProvider>
      </ConfirmProvider>
    </LoaderProvider>
  );
};

export default AppProvider;
