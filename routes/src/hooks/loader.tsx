import React, { createContext, useContext, useState } from 'react';

interface iLoader {
  loading: boolean;
  showLoader(): void;
  hideLoader(): void;
}

const LoaderContext = createContext<iLoader>({} as iLoader);

const LoaderProvider: React.FC = ({ children }) => {
  const [loading, setLoading] = useState<boolean>(false);

  const showLoader = () => {
    setLoading(true);
  };

  const hideLoader = () => {
    setLoading(false);
  };

  return (
    <LoaderContext.Provider value={{ loading, showLoader, hideLoader }}>
      {children}
    </LoaderContext.Provider>
  );
};

function useLoader() {
  const context = useContext(LoaderContext);

  if (!context) {
    throw new Error('useLoader must be used within a LoaderProvider');
  }

  return context;
}

export { useLoader, LoaderProvider };
