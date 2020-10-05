import React, { InputHTMLAttributes, useState, useEffect } from "react";

import { Container, Suffix } from "./styles";
import { Eye, EyeOff } from "react-feather";

type iInputType = "password" | "text";
interface iPassword extends InputHTMLAttributes<HTMLInputElement> {
  name: string;
}

function Password({ name, placeholder, value, ...props }: iPassword) {
  const [showPass, setShowPass] = useState<boolean>(false);
  const [inputType, setInputType] = useState<iInputType>("password");
  const [hasFocus, setHasFocus] = useState<boolean>(false);

  const handleFocus = () => {
    setHasFocus(true);
  };

  const handleBlur = () => {
    setHasFocus(false);
  };

  useEffect(() => {
    if (showPass) {
      setInputType("text");
    } else {
      setInputType("password");
    }
  }, [showPass]);

  return (
    <Container hasFocus={hasFocus} className="ll-input ll-input-email">
      <input
        {...props}
        type={inputType}
        name={name}
        onFocus={handleFocus}
        onBlur={handleBlur}
        placeholder={placeholder}
      />
      <Suffix
        className="input-sufix"
        onClick={() => setShowPass(!showPass)}
        showPass={showPass}
      >
        <Eye className="show" />
        <EyeOff className="hide" />
      </Suffix>
    </Container>
  );
}

export default Password;
