import React, { useCallback, useState, useEffect } from 'react';
import { FiEdit2, FiTrash2 } from 'react-icons/fi';
import 'antd/lib/badge/style/css';
import Tag from 'antd/lib/tag';
import 'antd/lib/tag/style/css';
import antConfirm from 'antd/lib/modal/confirm';
import { FcFactory, FcManager } from 'react-icons/fc';

import { Container } from 'pages/layout/Pages/styles';

import utils from 'utils';
import Table, { TableActions } from 'components/Table';
import Button from 'components/Button';
import { OnSearchProps } from 'components/Form/Search';
import PageLoader from 'components/PageLoader';
import { useLoader } from 'hooks/loader.hook';
import CustomerForm from 'pages/Customers/customer.form';
import { PageHeader } from 'pages/layout/Pages';
import Main from 'pages/layout/Main';
import Customer, {
  CustomerDataList,
  CustomerStates,
} from 'modules/Customers/customer.entity';
import customerService from 'modules/Customers/customer.service';

const Customers: React.FC = () => {
  const { showLoader, hideLoader, active: loading } = useLoader();
  const [showForm, setShowForm] = useState<boolean>(false);
  const [customerData, setCustomerData] = useState<
    CustomerDataList[] | undefined
  >([]);
  const [selectedRecord, setSelectedRecord] = useState<number | null>(null);
  const [searchTerm, setSearchTerm] = useState<string | null>(null);
  const [tableData, setTableData] = useState<CustomerDataList[]>([]);

  const searchable = ['name', 'email', 'activeText'];

  const fetchCustomers = useCallback(async () => {
    showLoader();
    const customerList = await customerService.fetch();
    setCustomerData(customerList);
    hideLoader();
  }, []);
  const handleSearch = () => {};
  // const handleSearch: OnSearchProps = useCallback((value): void => {
  //   showLoader();
  //   setSearchTerm(value);
  //   hideLoader();
  // }, []);

  const handleAdd = useCallback((): void => {
    setShowForm(true);
  }, []);

  const handleEdit = useCallback((id: number): void => {
    setSelectedRecord(id);
    setShowForm(true);
  }, []);

  const handleDelete = useCallback((id: number) => {
    const deleteCustomer = async () => {
      await customerService.delete(id);
      fetchCustomers();
    };

    antConfirm({
      title: 'Confirma exclusão?',
      content: 'Esta ação não pode ser desfeita',
      className: 'll-confirm-danger',
      okText: 'Sim, confirmo',
      cancelText: 'Não, cancelar',
      onOk: () => deleteCustomer(),
    });
  }, []);

  useEffect(() => {
    showLoader();
    // if (!showForm) {
    setShowForm(false);
    setSelectedRecord(null);
    fetchCustomers();
    // }
    hideLoader();
  }, [!showForm]);

  useEffect(() => {
    showLoader();
    setTableData(customerData ?? []);
    if (searchTerm) {
      const filtered = utils.filter(searchable, searchTerm, customerData);
      setTableData(filtered);
    }
    hideLoader();
  }, [searchTerm, customerData]);

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
      key: 'active',
      title: 'Ativo',
      dataIndex: 'active',
      render: (active: string, record: CustomerDataList) => {
        return active === CustomerStates.active ? (
          <Tag color="green">Ativo</Tag>
        ) : (
          <Tag color="red">Inativo</Tag>
        );
      },
    },
    {
      key: 'actions',
      width: '100px',
      dataIndex: 'key',
      render: (key: number, record: Customer) => (
        <TableActions>
          <Button title="Editar" onClick={() => handleEdit(key)}>
            <FiEdit2 size={16} />
          </Button>
          <Button
            title="Excluir"
            role="button"
            onClick={() => handleDelete(key)}
          >
            <FiTrash2 size={16} />
          </Button>
        </TableActions>
      ),
    },
  ];

  return (
    <>
      <PageLoader show={loading} />
      <Main>
        <Container>
          <PageHeader
            title="Clientes"
            onSearch={handleSearch}
            onAdd={handleAdd}
          />
          <Table columns={columns} loading={loading} dataSource={tableData} />
          <CustomerForm
            visible={showForm}
            onClose={() => setShowForm(false)}
            recordID={selectedRecord}
          />
        </Container>
      </Main>
    </>
  );
};

export default Customers;
