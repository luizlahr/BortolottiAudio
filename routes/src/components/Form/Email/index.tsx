import React, { InputHTMLAttributes, useEffect, useState } from 'react';

import { Container } from './styles';

interface iEmail extends InputHTMLAttributes<HTMLInputElement> {
  name: string;
  width?: string;
}

function Email({
  name,
  placeholder,
  value,
  disabled,
  width,
  ...props
}: iEmail) {
  const [hasFocus, setHasFocus] = useState<boolean>(false);
  const [isDisabled, setIsDisabled] = useState<boolean>(false);

  useEffect(() => {
    setIsDisabled(!!disabled);
  }, [disabled]);

  const handleFocus = () => {
    setHasFocus(true);
  };

  const handleBlur = () => {
    setHasFocus(false);
  };

  return (
    <Container
      hasFocus={hasFocus}
      isDisabled={isDisabled}
      className="ll-input ll-input-email"
      width={width}
    >
      <input
        {...props}
        onFocus={handleFocus}
        onBlur={handleBlur}
        type="email"
        name={name}
        disabled={isDisabled}
        placeholder={placeholder}
      />
    </Container>
  );
}

export default Email;
