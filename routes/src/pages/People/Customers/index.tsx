import React from 'react';
import Table from 'antd/es/table';
import 'antd/es/table/style/css';

import Layout from 'pages/layout/Main';
import Page from 'pages/layout/Page';
import Search from 'components/Form/Search';
import TableActions from 'components/TableActions';
import Button from 'components/Button';
import { useNavigate } from 'react-router-dom';

const crumbs = [{ label: 'Cadastros' }, { label: 'Clientes', current: true }];

const columns = [
  {
    title: 'Nome',
    dataIndex: 'name',
    key: 'name',
  },
  {
    title: 'E-mail',
    dataIndex: 'email',
    key: 'email',
  },
  {
    title: 'Endereço',
    dataIndex: 'address',
    key: 'address',
  },
  {
    title: 'Contato',
    dataIndex: 'phone',
    key: 'phone',
  },
  {
    title: '',
    key: 'actions',
  },
];

export default function Customers() {
  const navigate = useNavigate();

  const addCustomers = () => {
    navigate('/people/customers/create');
  };

  const handleEdit = () => {
    navigate('/people/customers/1');
  };

  return (
    <Layout>
      <Page title="Clientes" crumbs={crumbs}>
        <TableActions>
          <Search
            name="search"
            width="300px"
            placeholder="Buscar por..."
            autoFocus
            onSearch={console.log}
          />
          <Button color="primary" onClick={handleEdit}>
            Editar
          </Button>
          <Button color="primary" onClick={addCustomers}>
            Adicionar
          </Button>
        </TableActions>
        <Table columns={columns} />
      </Page>
    </Layout>
  );
}
