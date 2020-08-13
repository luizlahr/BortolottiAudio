import React, { useCallback, useEffect, useState } from 'react';

import { Container, Error } from './styles';

interface IFormControl {
  label?: string;
  field?: string;
  error?: string;
}

const FormControl: React.FC<IFormControl> = ({
  children,
  label,
  field,
  error,
}) => {
  const [hasError, setHasError] = useState<boolean>(false);

  useEffect(() => {
    setHasError(!!error);
  }, [error]);

  const renderLabel = useCallback((text: string, field?: string) => {
    return <label htmlFor={field}>{text}</label>;
  }, []);

  const renderError = useCallback((error: string) => {
    return <Error>{error}</Error>;
  }, []);

  return (
    <Container className="ll-form-control" hasError={hasError}>
      {label && renderLabel(label, field)}
      {children}
      {error && renderError(error)}
    </Container>
  );
};

export default FormControl;
