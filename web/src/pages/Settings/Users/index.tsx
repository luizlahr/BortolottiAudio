import React, { useCallback, useState, useEffect } from 'react';
import { FiEdit2, FiTrash2 } from 'react-icons/fi';
import 'antd/lib/badge/style/css';
import Tag from 'antd/lib/tag';
import 'antd/lib/tag/style/css';

import { Container } from 'pages/layout/Pages/styles';
import { TagStyle } from './styles';

import utils from 'utils';
import Table, { TableActions } from 'components/Table';
import Button from 'components/Button';
import { OnSearchProps } from 'components/Form/Search';
import UserForm from 'pages/Settings/Users/user.form';
import { PageHeader } from 'pages/layout/Pages';
import Main from 'pages/layout/Main';
import User, { UserDataList, UserStates } from 'modules/Users/user.entity';
import userService from 'modules/Users/user.service';
import { useLoader } from 'hooks/loader.hook';
import { useConfirm } from 'hooks/confirm.hook';

const Users: React.FC = () => {
  const { showLoader, hideLoader, active: loading } = useLoader();
  const { confirm } = useConfirm();
  const [showForm, setShowForm] = useState<boolean>(false);
  const [userData, setUserData] = useState<UserDataList[] | undefined>([]);
  const [selectedRecord, setSelectedRecord] = useState<number | null>(null);
  const [searchTerm, setSearchTerm] = useState<string | null>(null);
  const [tableData, setTableData] = useState<UserDataList[]>([]);

  const searchable = ['name', 'email', 'activeText'];

  const fetchUsers = useCallback(async () => {
    showLoader();
    const userList = await userService.fetch();
    setUserData(userList);
    hideLoader();
  }, []);

  const handleSearch: OnSearchProps = useCallback((value): void => {
    showLoader();
    setSearchTerm(value);
    hideLoader();
  }, []);

  const handleAdd = useCallback((): void => {
    setShowForm(true);
  }, []);

  const handleEdit = useCallback((id: number): void => {
    setSelectedRecord(id);
    setShowForm(true);
  }, []);

  const handleDelete = useCallback((id: number) => {
    const deleteUser = async () => {
      showLoader();
      await userService.delete(id);
      hideLoader();
      fetchUsers();
    };

    confirm({
      cancelText: 'Cancelar',
      okText: 'OK',
      onOk: deleteUser,
      onCancel: () => {},
      title: 'Confirma exclusão?',
      message: 'Uma vez o usuário excluído, não há reversão!',
      color: 'danger',
    });
  }, []);

  useEffect(() => {
    if (!showForm) {
      setShowForm(false);
      setSelectedRecord(null);
      fetchUsers();
    }
  }, [!showForm]);

  useEffect(() => {
    setTableData(userData ?? []);
    if (searchTerm) {
      const filtered = utils.filter(searchable, searchTerm, userData);
      setTableData(filtered);
    }
  }, [searchTerm, userData]);

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
      render: (active: string, record: UserDataList) => {
        return active === UserStates.active ? (
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
      render: (key: number, record: User) => (
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
      <Main>
        <Container>
          <TagStyle />
          <PageHeader
            title="Usuários"
            onSearch={handleSearch}
            onAdd={handleAdd}
            loading={loading}
          />
          <Table columns={columns} dataSource={tableData} />
          <UserForm
            visible={showForm}
            onClose={() => setShowForm(false)}
            recordID={selectedRecord}
          />
        </Container>
      </Main>
    </>
  );
};

export default Users;
