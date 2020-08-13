import React, { useCallback, useState } from 'react';
import { FiEdit2, FiTrash2 } from 'react-icons/fi';
import { FcFactory, FcManager } from 'react-icons/fc';

import { Container } from '../layout/Pages/styles';

import Table, { TableActions } from 'components/Table';
import { PageHeader } from 'pages/layout/Pages';
import Button from 'components/Button';
import Span from 'components/Span';
import OrderForm from './OrderForm';
import { OnSearchProps } from 'components/Form/Search';

interface IOrder {
  key: string;
  business: boolean;
  name: string;
  nickname: string;
  email: string;
  phone: string;
  city: string;
  state: string;
}

const Customers: React.FC = () => {
  const [showForm, setShowForm] = useState(false);

  const columns = [
    {
      key: 'key',
      title: '#',
      width: '90px',
      dataIndex: 'key',
    },
    {
      key: 'business',
      title: 'Tipo',
      width: '50px',
      render: (text: string, record: IOrder) => (
        <Span>
          {record.business && (
            <FcFactory size={28} style={{ marginRight: 8 }} />
          )}
          {record.business || (
            <FcManager size={28} style={{ marginRight: 8 }} />
          )}
        </Span>
      ),
    },
    {
      key: 'name',
      title: 'Nome',
      dataIndex: 'name',
      render: (text: string, record: IOrder, index: number) => (
        <Span direction="vertical">
          {record.name}
          <small>{record.nickname}</small>
        </Span>
      ),
    },
    {
      key: 'email',
      title: 'Contato',
      dataIndex: 'email',
      render: (text: string, record: IOrder, index: number) => (
        <Span direction="vertical">
          {record.phone}
          <small>{text}</small>
        </Span>
      ),
    },
    {
      key: 'city',
      title: 'Cidade',
      dataIndex: 'city',
      render: (text: string, record: IOrder, index: number) => (
        <Span>
          {record.city}
          {record.city && record.state && ', '}
          {record.state}
        </Span>
      ),
    },
    {
      key: 'actions',
      width: '100px',
      render: (text: string, record: IOrder, index: number) => (
        <TableActions>
          <Button title="Editar">
            <FiEdit2 size={16} />
          </Button>
          <Button title="Excluir">
            <FiTrash2 size={16} />
          </Button>
        </TableActions>
      ),
    },
  ];

  const customerData = [
    {
      key: 1,
      business: false,
      name: 'Luiz Lahr',
      nickname: 'desenvolvedor',
      phone: '2441 8848',
      email: 'luiz.lahr@hotmail.com',
      city: 'Copenhagen',
      state: 'DK',
    },
    {
      key: 2,
      business: true,
      name: 'Luiz Lahr',
      nickname: 'mozão',
      phone: '2441 8848',
      email: 'luiz.lahr@hotmail.com',
      city: 'Copenhagen',
      state: 'DK',
    },
  ];
  const handleSearch = () => {};
  // const handleSearch: OnSearchProps = useCallback((value): void => {
  //   console.log(value);
  // }, []);

  const handleAdd = useCallback((): void => {
    setShowForm(true);
  }, []);

  const handleEdit = useCallback((): void => {
    setShowForm(true);
  }, []);

  const handleOnClose = useCallback((): void => {
    setShowForm(false);
  }, []);

  return (
    <Container>
      <PageHeader title="Ordens" onSearch={handleSearch} onAdd={handleAdd} />
      <Table columns={columns} dataSource={customerData} />
      <OrderForm visible={showForm} onClose={handleOnClose} />
    </Container>
  );
};

export default Customers;
