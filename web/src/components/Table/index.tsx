import React from 'react';
import AntTable, { TableProps } from 'antd/lib/table';
import Empty from 'antd/lib/empty';

import { Container, ActionContainer } from './styles';

const EmptyPlaceholder = () => (
  <Empty description="Nenhum registro encontrado!" />
);

const Table: React.FC<any> = ({
  columns,
  dataSource,
  loading,
  size,
  ...props
}: TableProps<any>) => {
  return (
    <Container>
      <AntTable
        columns={columns}
        dataSource={dataSource}
        locale={{ emptyText: <EmptyPlaceholder /> }}
        loading={loading}
        size={size || "small"}
        {...props}
        pagination={{ size: 'small' }}
      />
    </Container>
  );
};

export default Table;

export const TableActions: React.FC = ({ children, ...props }) => {

  return (
    <>
      <ActionContainer {...props}>
        {children}
      </ActionContainer>
    </>
  )

}
