import React from 'react';
import SearchInput from 'antd/es/input/Search';
import { SearchProps } from 'antd/es/input';
import 'antd/es/input/style/css';

import { SearchStyles } from './styles';

export type OnSearchProps = (
  value: string,
  event?:
    | React.ChangeEvent<HTMLInputElement>
    | React.MouseEvent<HTMLElement>
    | React.KeyboardEvent<HTMLInputElement>,
) => void;

const Search: React.FC<SearchProps> = ({ width, ...props }) => {
  return (
    <>
      <SearchStyles hasFocus={false} isDirty={false} width={width || 200} />
      <SearchInput className="ll-input-search" {...props} />
    </>
  );
};

export default Search;
