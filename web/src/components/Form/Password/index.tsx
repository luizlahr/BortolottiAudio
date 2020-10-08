import React, { InputHTMLAttributes, useState } from 'react';
import { Eye, EyeOff } from 'react-feather';
import { Container } from './styles';
import AntInput from 'antd/es/input';
import 'antd/es/input/style/css';

function Password({
  type,
  placeholder,
  name,
  size,
  ...rest
}: InputHTMLAttributes<HTMLInputElement>) {
  const [focus, setFocus] = useState(false);
  const [showPass, setShowPass] = useState(false);

  const handleFocus = () => {
    setFocus(true);
  };

  const handleBlur = () => {
    setFocus(false);
  };

  const handleShowPass = () => {
    setShowPass(!showPass);
  };

  return (
    <Container focus={focus}>
      <AntInput
        type={showPass ? 'text' : 'password'}
        name={name}
        {...rest}
        onFocus={handleFocus}
        onBlur={handleBlur}
      />
      <span className="password-sufix" onClick={handleShowPass}>
        {showPass === true && <EyeOff />}
        {showPass === false && <Eye />}
      </span>
    </Container>
  );
}

export default Password;
