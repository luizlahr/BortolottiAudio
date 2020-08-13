import React from 'react';

import FormikSwitch, { SwitchProps } from 'formik-antd/es/switch';
import 'antd/lib/switch/style/css';

import { SwitchStyles } from './styles';

interface ICheck {
  name: string;
  value: string | number | boolean;
}

const Switch: React.FC<SwitchProps> = ({ ...props }) => {
  return (
    <>
      <SwitchStyles />
      <FormikSwitch {...props} />
    </>
  );
};

export default Switch;
