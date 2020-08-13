import React, { createContext, useContext, useState, useEffect } from 'react';
import { useLocation } from 'react-router';

interface MenuStateProps {
  showMenu: boolean;
  menuActive: string | undefined;
}

interface MenuContextProps {
  showMenu: boolean;
  menuActive: string | undefined;
  toggleMenu(newState?: boolean): void;
  setActiveMenu(active: string): void;
}

const storagePrefix = '@BortoAudio';
const MenuContext = createContext<MenuContextProps>({} as MenuContextProps);

const MenuProvider: React.FC = ({ children }) => {
  const location = useLocation();
  const [data, setData] = useState<MenuStateProps>(() => {
    const showMenu =
      localStorage.getItem(`${storagePrefix}:showMenu`) === 'true'
        ? true
        : false;
    const menuActive =
      localStorage.getItem(`${storagePrefix}:activeMenu`) || undefined;

    return { showMenu, menuActive };
  });

  const toggleMenu = (newState?: boolean) => {
    let showMenu = !data.showMenu;

    if (newState) {
      showMenu = newState;
    }

    localStorage.setItem(`${storagePrefix}:showMenu`, showMenu.toString());
    setData({ ...data, showMenu });
  };

  const setActive = (currentUrl: string) => {
    localStorage.setItem(`${storagePrefix}:activeMenu`, currentUrl);
    setData({
      ...data,
      menuActive: currentUrl,
      showMenu: data.menuActive === currentUrl ? data.showMenu : false,
    });
  };

  useEffect(() => {
    const setMenu = () => {
      if (location.pathname !== data.menuActive) {
        toggleMenu(false);
      }
      setActive(location.pathname);
    };
    setMenu();
  }, [location.pathname, data.menuActive]);

  const setActiveMenu = (menuActive: string): void => {};

  return (
    <MenuContext.Provider
      value={{
        showMenu: data.showMenu,
        menuActive: data.menuActive,
        toggleMenu,
        setActiveMenu,
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
