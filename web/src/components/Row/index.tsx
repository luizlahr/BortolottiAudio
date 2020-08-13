import React from 'react';
import AntRow from 'antd/lib/row';
import 'antd/lib/row/style/css';

const Row: React.FC = ({ children }) => {
  return <AntRow gutter={[24, 24]}>{children}</AntRow>;
};

export default Row;
