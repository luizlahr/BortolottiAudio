import React from 'react';
import classnames from 'classnames/bind'
import { Link } from 'react-router-dom'

interface IMenuItem {
  label: string;
  url: string;
  isSub: boolean;
  isActive: boolean;
  isOpen?: boolean;
  toggleSubMenu: (url: string) => void;
}

const MenuItem: React.FC<IMenuItem> = ({ children, label, url, isSub, isActive, isOpen, toggleSubMenu }) => {

  const classes = classnames({
    active: isActive,
    open: isOpen
  })

  if (!isSub) {
    return (
      <li className={classes}>
        <Link to={url || "#"}>
          {label}
        </Link>
      </li>
    )
  }

  return (
    <li className={classes} >
      <span
        onClick={() => toggleSubMenu(url)}
      >
        {label}
      </span>
      <ul>
        {children}
      </ul>
    </li >
  )
};

export default MenuItem;
