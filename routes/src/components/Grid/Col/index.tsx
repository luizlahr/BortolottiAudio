import React from 'react';
import 'antd/es/col/style/css';
import { ColProps } from 'antd/es/col';

import { Container } from './styles';

const Col: React.FC<ColProps> = ({ children, ...props }) => {
  return <Container {...props}>{children}</Container>;
};

export default Col;
