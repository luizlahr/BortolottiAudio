import React from 'react';

import { Container } from './styles';
import ErrorBoundary from 'exceptions/boundry';

const Base: React.FC = ({ children }) => {
  return (
    <ErrorBoundary>
      <Container className="ll-base">{children}</Container>
    </ErrorBoundary>
  );
};

export default Base;
