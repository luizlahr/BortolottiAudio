import React, { useCallback, useState } from 'react';
import { FiEdit2, FiTrash2 } from 'react-icons/fi';

import { Container } from 'pages/layout/Pages/styles';

import Table, { TableActions } from 'components/Table';
import { PageHeader } from 'pages/layout/Pages';
import Button from 'components/Button';
import ModelsForm from 'pages/Equipments/Models/ModelsForm';
import { OnSearchProps } from 'components/Form/Search';

interface ICategory {
  id: number;
  name: string;
}

interface IBrand {
  id: number;
  name: string;
}

interface IModels {
  key: string;
  name: string;
  category_id: number;
  brand_id: number;
  category: ICategory;
  brand: IBrand;
}

const Models: React.FC = () => {
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
      title: 'Modelo',
      dataIndex: 'name',
    },
    {
      key: 'category_id',
      title: 'Categoria',
      dataIndex: 'category_id',
      render: (text: string, record: IModels) =>
        `${text} - ${record.category.name}`,
    },
    {
      key: 'brand_id',
      title: 'Marca',
      dataIndex: 'brand_id',
      render: (text: string, record: IModels) =>
        `${text} - ${record.brand.name}`,
    },
    {
      key: 'actions',
      width: '100px',
      render: (text: string, record: IModels, index: number) => (
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
      name: 'R2-D2',
      category_id: 2,
      brand_id: 2,
      category: {
        id: 1,
        name: 'Amplificador',
      },
      brand: {
        id: 1,
        name: 'StarWars',
      },
    },
    {
      key: 2,
      name: 'CP3-O',
      category_id: 1,
      brand_id: 1,
      category: {
        id: 1,
        name: 'Guitarra',
      },
      brand: {
        id: 1,
        name: 'StarWars',
      },
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
        title="Modelos de Equipamentos"
        onSearch={handleSearch}
        onAdd={handleAdd}
      />
      <Table columns={columns} dataSource={customerData} />
      <ModelsForm visible={showForm} onClose={handleOnClose} />
    </Container>
  );
};

export default Models;
