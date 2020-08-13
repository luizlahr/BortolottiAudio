import React, { useState, useCallback } from 'react';
import FormikInput, { InputProps } from 'formik-antd/es/input'
import 'antd/es/input/style/css'

import { InputStyles } from './styles'

interface IInput extends InputProps {
  uc?: boolean
}

const Input: React.FC<IInput> = ({ uc: uncontrolled, ...props }) => {
  const [hasFocus, setHasFocus] = useState<boolean>(false);
  const [isDirty, setIsDirty] = useState<boolean>(false);

  const handleFocus = useCallback((event: React.FocusEvent<HTMLInputElement>) => {
    setIsDirty(!!event.target.value);
    setHasFocus(true);
  }, []);

  const handleBlur = useCallback((event: React.FocusEvent<HTMLInputElement>) => {
    setIsDirty(!!event.target.value);
    setHasFocus(false);
  }, [])

  return (
    <>
      <InputStyles />
      <FormikInput
        onBlur={handleBlur}
        onFocus={handleFocus}
        className={`ll-input`}
        {...props}
      />
    </>
  );
};

export default Input;
