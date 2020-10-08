import React from 'react';
import { useMenu } from 'hooks/menu';

import { Container } from './styles';

function Overlay() {
  const { menuOn, hideMenu } = useMenu();
  return <Container show={menuOn} onClick={hideMenu} />;
}

export default Overlay;
