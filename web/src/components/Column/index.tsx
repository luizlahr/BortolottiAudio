import React from 'react';
import AntColumn, { ColProps } from 'antd/lib/col';
import 'antd/lib/col/style/css';

const Columnn: React.FC<ColProps> = (props) => {
  const { children } = props;
  return (
    <>
      <AntColumn {...props}>{children}</AntColumn>
    </>
  );
};

export default Columnn;
