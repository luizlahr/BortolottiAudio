import React from 'react';
import FormikRadio, { RadioGroupProps } from 'formik-antd/es/radio';
import 'formik-antd/es/radio/style/css';

const Radio: React.FC<RadioGroupProps> = (props) => {
  return (
    <>
      <FormikRadio.Group {...props} />
    </>
  );
};

export default Radio;
