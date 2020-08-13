import React, { useCallback, useState } from 'react';
import { FiEdit2, FiTrash2 } from 'react-icons/fi';

import { Container } from 'pages/layout/Pages/styles';

import Table, { TableActions } from 'components/Table';
import { PageHeader } from 'pages/layout/Pages';
import Button from 'components/Button';
import BrandsForm from 'pages/Equipments/Brands/BrandsForm';
import { OnSearchProps } from 'components/Form/Search';

interface IBrands {
  key: string;
  name: string;
}

const Brands: React.FC = () => {
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
      key: 'actions',
      width: '100px',
      render: (text: string, record: IBrands, index: number) => (
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
      name: 'Vox',
    },
    {
      key: 2,
      name: 'Marshal',
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
        title="Marcas de Equipamentos"
        onSearch={handleSearch}
        onAdd={handleAdd}
      />
      <Table columns={columns} dataSource={customerData} />
      <BrandsForm visible={showForm} onClose={handleOnClose} />
    </Container>
  );
};

export default Brands;
