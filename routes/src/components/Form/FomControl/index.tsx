import React, { useEffect, useState } from "react";

import { Container } from "./styles";

interface iFormControl {
  label?: string;
  error?: string;
}

const FormControl: React.FC<iFormControl> = ({ label, error, children }) => {
  const [hasError, setHasError] = useState<boolean>(false);

  useEffect(() => {
    setHasError(!!error);
  }, [error]);

  return (
    <Container hasError={hasError}>
      {label && <label>{label}</label>}
      <div>{children}</div>
      {error && <span className="error-msg">{error}</span>}
    </Container>
  );
};

export default FormControl;
