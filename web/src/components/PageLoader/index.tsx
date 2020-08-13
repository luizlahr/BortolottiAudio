import React from 'react';

import { Container, Overlay, Spinner, Bar } from './styles';

interface LoaderProps {
  show: boolean;
}

const PageLoader: React.FC<LoaderProps> = ({ show }) => {
  return (
    <Container show={show}>
      <Overlay />
      <Spinner className="ll-spinner">
        <Bar className="bar-1" />
        <Bar className="bar-2" />
        <Bar className="bar-3" />
        <Bar className="bar-4" />
        <Bar className="bar-5" />
      </Spinner>
    </Container>
  );
};

export default PageLoader;
