import React from 'react';
import { RefreshCw } from 'react-feather';
import { useLoader } from 'hooks/loader';

import { Container } from './styles';

const Loader: React.FC = () => {
  const { loading } = useLoader();

  return (
    <Container className="ll-loader" show={loading}>
      <RefreshCw />
    </Container>
  );
};

export default Loader;
