import React, { useState, useEffect } from 'react';

import { MenuContainer } from './styles';

import { useMenu } from 'hooks/menu.hook';
import MenuItem from './Item';
import menuItems from './menuItens';

interface IMenuItem {
  label: string;
  url: string;
  subs?: Array<IMenuItem>;
}

const Menu: React.FC = () => {
  const { menuActive } = useMenu();
  const [subOpen, setSubOpen] = useState<string | null>(null);

  useEffect(() => {
    if (subOpen !== menuActive) {
      setSubOpen(null);
    }
  }, [menuActive]);

  const toggleSubMenus = (url: string) => {
    if (subOpen === url) {
      setSubOpen(null);
      return;
    }

    setSubOpen(url);
  };

  const isActive = (url: string, subs?: Array<IMenuItem>) => {
    if (subs) {
      const activeSub = subs.filter((sub) => sub.url === menuActive);
      if (activeSub.length > 0) {
        return true;
      }
    }

    return menuActive === url;
  };

  const isSubOpen = (url: string) => {
    if (subOpen === url) {
      return true;
    }

    return false;
  };

  return (
    <MenuContainer>
      {menuItems.map((item) => (
        <MenuItem
          key={item.url}
          label={item.label}
          url={item.url}
          isActive={isActive(item.url, item.subs)}
          isOpen={isSubOpen(item.url) || isActive(item.url, item.subs)}
          isSub={!!item.subs && item.subs.length > 0}
          toggleSubMenu={toggleSubMenus}
        >
          {item.subs && (
            <ul>
              {item.subs.map((subitem) => (
                <MenuItem
                  key={subitem.url}
                  label={subitem.label}
                  url={subitem.url}
                  isActive={isActive(subitem.url)}
                  isSub={false}
                  toggleSubMenu={toggleSubMenus}
                />
              ))}
            </ul>
          )}
        </MenuItem>
      ))}
    </MenuContainer>
  );
};

export default Menu;
