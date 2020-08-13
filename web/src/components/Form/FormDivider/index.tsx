import React from 'react';

import { Container } from './styles';

interface IDivider {
  text?: string;
  color?: 'default' | 'primary' | 'danger' | 'success' | 'warning';
}

const FormDivider: React.FC<IDivider> = ({ text, color }) => {
  return (
    <Container color={color}>
      {text && <span>{text}</span>}
    </Container>
  );
};

export default FormDivider;
