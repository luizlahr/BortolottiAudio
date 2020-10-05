import React, {
  createContext,
  useContext,
  useEffect,
  useState,
  useCallback,
} from 'react';
import { useLocation } from 'react-router-dom';

interface iMenu {
  menuOn: boolean;
  currentUrl: string;
  showMenu(): void;
  hideMenu(): void;
}

const MenuContext = createContext<iMenu>({} as iMenu);
const localStoragePrefix = '@BortoSystem';

const MenuProvider: React.FC = ({ children }) => {
  const location = useLocation();
  const storageMenuKey = `${localStoragePrefix}:menu`;
  const storageUrlKey = `${localStoragePrefix}:currentUrl`;

  const setMenuString = useCallback((value: boolean) => {
    if (!value) {
      localStorage.setItem(storageMenuKey, JSON.stringify(false));
      return;
    }

    localStorage.setItem(storageMenuKey, JSON.stringify(true));
  }, []);

  const setCurrentString = useCallback((value: string) => {
    setCurrentUrl(value);
    localStorage.setItem(storageUrlKey, value);
  }, []);

  const getMenuString = useCallback(() => {
    const value = localStorage.getItem(storageMenuKey);

    if (value === 'false') {
      return false;
    }

    return true;
  }, []);

  const getCurrentString = useCallback(() => {
    const value = localStorage.getItem(storageUrlKey);
    return value || '';
  }, []);

  const [menuOn, setMenuOn] = useState<boolean>(() => {
    return getMenuString();
  });

  const [currentUrl, setCurrentUrl] = useState<string>(() => {
    return getCurrentString();
  });

  useEffect(() => {
    setMenuString(menuOn);
    console.log(menuOn);
  }, [menuOn, setMenuOn]);

  useEffect(() => {
    if (currentUrl !== '' && currentUrl !== location.pathname) {
      setMenuOn(false);
    }
    setCurrentString(location.pathname);
  }, [location.pathname]);

  const showMenu = () => {
    setMenuOn(true);
  };

  const hideMenu = () => {
    setMenuOn(false);
  };

  return (
    <MenuContext.Provider value={{ menuOn, currentUrl, showMenu, hideMenu }}>
      {children}
    </MenuContext.Provider>
  );
};

function useMenu() {
  const context = useContext(MenuContext);

  if (!context) {
    throw new Error('useMenu must be used within a MenuProvider');
  }

  return context;
}

export { useMenu, MenuProvider };
