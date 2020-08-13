import React from 'react';

import Check, { CheckboxProps } from 'antd/lib/checkbox';
import 'antd/lib/checkbox/style/css';

interface ICheck {
  name: string;
  value: string | number | boolean;
}

const CheckBox: React.FC<CheckboxProps> = ({ ...props }) => {
  return <Check />;
};

export default CheckBox;
