import React from 'react';

import { FooterContainer } from './styles';

interface IModalFooter {
  children: React.ReactNode;
}

const Footer: React.FC<IModalFooter> = ({ children }) => {
  return (
    <FooterContainer>
      {children}
    </FooterContainer>
  )
}

export default Footer;
