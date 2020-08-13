import React from 'react';

import { Container } from './styles';

interface ISpan {
  direction?: "vertical" | "horizontal";
  full?: boolean;
}

const Component: React.FC<ISpan> = ({ children, full, direction }) => {
  return (
    <Container direction={direction || "horizontal"} full={full ? 1 : 0}>{children}</Container>
  );
};

export default Component;
