import React, { useCallback, useState } from 'react';
import { FiEdit2, FiTrash2 } from 'react-icons/fi';

import { Container } from 'pages/layout/Pages/styles';

import Table, { TableActions } from 'components/Table';
import { PageHeader } from 'pages/layout/Pages';
import Button from 'components/Button';
import UserForm from './MovementForm';
import { OnSearchProps } from 'components/Form/Search';

interface IMovement {
  key: string;
  business: boolean;
  name: string;
  nickname: string;
  email: string;
  phone: string;
  city: string;
  state: string;
}

const BankAccounts: React.FC = () => {
  const [showForm, setShowForm] = useState(false);

  const columns = [
    {
      key: 'key',
      title: '#',
      width: '90px',
      dataIndex: 'key',
    },
    {
      key: 'name',
      title: 'Nome',
      dataIndex: 'name',
    },
    {
      key: 'email',
      title: 'E-mail',
      dataIndex: 'email',
    },
    {
      key: 'actions',
      width: '100px',
      render: (text: string, record: IMovement, index: number) => (
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

  const userData = [
    {
      key: 1,
      name: 'Luiz Lahr',
      email: 'luiz.lahr@hotmail.com',
    },
    {
      key: 2,
      name: 'Lucio cezar',
      email: 'atendimento@bortolottiaudio.com.br',
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
      <PageHeader
        title="Contas Bancárias"
        onSearch={handleSearch}
        onAdd={handleAdd}
      />
      <Table columns={columns} dataSource={userData} />
      <UserForm visible={showForm} onClose={handleOnClose} />
    </Container>
  );
};

export default BankAccounts;
