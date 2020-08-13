import React from 'react';
import Button from '../../../components/Button';

import { PageHeaderContainer } from './styles';
import { FiPlus, FiSearch } from 'react-icons/fi';
import Search, { OnSearchProps } from '../../../components/Form/Search';
import { SubmitHandler } from '@unform/core';

interface IPageHeader {
  onSearch?: OnSearchProps;
  onAdd?: () => void;
  title?: string | React.ReactNode;
  loading?: boolean;
}

export const PageHeader: React.FC<IPageHeader> = ({
  title,
  onSearch,
  onAdd,
  loading,
}) => {
  return (
    <PageHeaderContainer>
      {title && <h2 className="ll-page-title">{title}</h2>}
      {onSearch && <Search name="search" onSearch={onSearch} width={300} />}
      {onAdd && (
        <Button
          solid
          rounded
          color="primary"
          className="ll-button-add"
          onClick={onAdd}
          title="Adicionar"
          loading={loading}
        >
          <FiPlus size={20} />
        </Button>
      )}
    </PageHeaderContainer>
  );
};
