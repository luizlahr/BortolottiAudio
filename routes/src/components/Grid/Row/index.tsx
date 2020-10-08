import React from 'react';
import 'antd/es/row/style/css';
import { RowProps } from 'antd/es/row';

import { Container } from './styles';

const Row: React.FC<RowProps> = ({ children }) => {
  return <Container gutter={[16, 16]}>{children}</Container>;
};

export default Row;
