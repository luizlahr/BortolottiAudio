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
  openMenu: string;
  showMenu(): void;
  hideMenu(): void;
  handleOpenMenu(menu: string): void;
}

const MenuContext = createContext<iMenu>({} as iMenu);
const localStoragePrefix = '@BortoSystem';

const MenuProvider: React.FC = ({ children }) => {
  const location = useLocation();
  const storageMenuKey = `${localStoragePrefix}:menu`;
  const storageUrlKey = `${localStoragePrefix}:currentUrl`;
  const storageOpenKey = `${localStoragePrefix}:openMenu`;

  const setMenuString = useCallback(
    (value: boolean) => {
      if (!value) {
        localStorage.setItem(storageMenuKey, JSON.stringify(false));
        return;
      }

      localStorage.setItem(storageMenuKey, JSON.stringify(true));
    },
    [storageMenuKey],
  );

  const setCurrentString = useCallback(
    (value: string) => {
      setCurrentUrl(value);
      localStorage.setItem(storageUrlKey, value);
    },
    [storageUrlKey],
  );

  const setOpenString = useCallback(
    (value: string) => {
      if (!value) {
        localStorage.setItem(storageOpenKey, '');
        return;
      }

      localStorage.setItem(storageOpenKey, value);
    },
    [storageOpenKey],
  );

  const getMenuString = useCallback(() => {
    const value = localStorage.getItem(storageMenuKey);

    if (value === 'false') {
      return false;
    }

    return true;
  }, [storageMenuKey]);

  const getCurrentString = useCallback(() => {
    const value = localStorage.getItem(storageUrlKey);
    return value || '';
  }, [storageUrlKey]);

  const getOpenString = useCallback(() => {
    const value = localStorage.getItem(storageOpenKey);
    return value || '';
  }, [storageOpenKey]);

  const [menuOn, setMenuOn] = useState<boolean>(() => {
    return getMenuString();
  });

  const [currentUrl, setCurrentUrl] = useState<string>(() => {
    return getCurrentString();
  });

  const [openMenu, setOpenMenu] = useState<string>(() => {
    return getOpenString();
  });

  useEffect(() => {
    setMenuString(menuOn);
    console.log(menuOn);
  }, [menuOn, setMenuOn, setMenuString]);

  useEffect(() => {
    if (currentUrl !== '' && currentUrl !== location.pathname) {
      setMenuOn(false);
    }
    setCurrentString(location.pathname);
  }, [location.pathname, currentUrl, setMenuOn, setCurrentString]);

  useEffect(() => {
    setOpenString(openMenu);
  }, [openMenu, setOpenString]);

  const showMenu = () => {
    setMenuOn(true);
  };

  const hideMenu = () => {
    setMenuOn(false);
  };

  const handleOpenMenu = (menu: string) => {
    if (menu === openMenu) {
      setOpenMenu('');
      return;
    }
    setOpenMenu(menu);
  };

  return (
    <MenuContext.Provider
      value={{
        menuOn,
        currentUrl,
        showMenu,
        hideMenu,
        openMenu,
        handleOpenMenu,
      }}
    >
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
