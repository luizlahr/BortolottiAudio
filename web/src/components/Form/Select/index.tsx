import React, { useState, useCallback } from 'react';
import FormikInput, { SelectProps } from 'formik-antd/es/select'

import { SelectStyles } from './styles';

interface IInput extends SelectProps {
  uc?: boolean
}

const Input: React.FC<IInput> = ({ options, ...props }) => {

  return (
    <>
      <SelectStyles />
      <FormikInput
        options={options}
        className={`ll-select`}
        {...props}
      />
    </>
  );
};

export default Input;
