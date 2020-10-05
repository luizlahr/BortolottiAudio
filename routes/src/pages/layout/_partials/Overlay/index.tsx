import React from 'react';
import { useMenu } from 'hooks/menu';

import { Container } from './styles';

function Overlay() {
  const { menuOn } = useMenu();
  return <Container show={menuOn} />;
}

export default Overlay;
