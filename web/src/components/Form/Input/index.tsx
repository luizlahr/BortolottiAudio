import React, { useState } from 'react';
import AntInput, { InputProps } from 'antd/es/input';
import 'antd/es/input/style/css';

import { Container } from './styles';

interface iInput extends InputProps {}

function Input({ type, placeholder, name, ...rest }: iInput) {
  const [focus, setFocus] = useState(false);

  const handleFocus = () => {
    setFocus(true);
  };

  const handleBlur = () => {
    setFocus(false);
  };

  return (
    <Container focus={focus}>
      <AntInput
        type={type}
        placeholder={placeholder}
        name={name}
        {...rest}
        onFocus={handleFocus}
        onBlur={handleBlur}
      />
    </Container>
  );
}

export default Input;
