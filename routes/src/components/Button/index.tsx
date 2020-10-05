import React, { ButtonHTMLAttributes } from 'react';
import { RefreshCw } from 'react-feather';

import { Container } from './styles';

interface iButton extends ButtonHTMLAttributes<HTMLButtonElement> {
  loading?: boolean;
  color?: 'default' | 'primary';
}

function Button({ children, loading, color = 'default' }: iButton) {
  return (
    <Container color={color} loading={loading ? 1 : 0} disabled={loading}>
      <span className="btn-loading">
        <RefreshCw />
      </span>
      <span className="btn-content">{children}</span>
    </Container>
  );
}

export default Button;
