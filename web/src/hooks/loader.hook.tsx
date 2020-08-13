import React, { createContext, useContext, useState } from 'react';
import PageLoader from 'components/PageLoader';

type LoaderState = boolean;

interface LoaderContextProps {
  active: LoaderState;
  showLoader(): void;
  hideLoader(): void;
}

const LoaderContext = createContext<LoaderContextProps>(
  {} as LoaderContextProps,
);

const LoaderProvider: React.FC = ({ children }) => {
  const [active, setActive] = useState<LoaderState>(false);

  const showLoader = (): void => {
    setActive(true);
  };

  const hideLoader = (): void => {
    setActive(false);
  };

  return (
    <LoaderContext.Provider
      value={{
        showLoader,
        hideLoader,
        active,
      }}
    >
      <PageLoader show={active} />
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
