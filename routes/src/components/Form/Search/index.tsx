import React, { InputHTMLAttributes, useEffect, useState } from 'react';
import { Search, XCircle } from 'react-feather';
import { Container } from './styles';

interface iInput extends InputHTMLAttributes<HTMLInputElement> {
  name: string;
  width?: string;
  onSearch(searchTerm: string): void;
}

function Input({
  name,
  placeholder,
  value,
  disabled,
  width,
  onSearch,
  ...props
}: iInput) {
  const [hasFocus, setHasFocus] = useState<boolean>(false);
  const [isDisabled, setIsDisabled] = useState<boolean>(false);
  const [searchTerm, setSearchTerm] = useState<string | undefined>(undefined);

  useEffect(() => {
    setIsDisabled(!!disabled);
  }, [disabled]);

  const handleFocus = () => {
    setHasFocus(true);
  };

  const handleBlur = () => {
    setHasFocus(false);
  };

  const handleKeyUp = (event: React.KeyboardEvent<HTMLInputElement>) => {
    if (event.key === 'Enter' && searchTerm) {
      handleSearch();
    }
  };

  const handleOnChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    setSearchTerm(event.target.value);
  };

  const handleSearch = () => {
    if (searchTerm) {
      onSearch(searchTerm);
    }
  };

  return (
    <Container
      hasFocus={hasFocus}
      isDisabled={isDisabled}
      className="ll-input ll-input-email"
      width={width}
    >
      <input
        {...props}
        onFocus={handleFocus}
        onBlur={handleBlur}
        type="text"
        name={name}
        disabled={isDisabled}
        placeholder={placeholder}
        onChange={handleOnChange}
        onKeyUp={handleKeyUp}
        value={searchTerm}
      />
      {!searchTerm && (
        <Search className="search-sufix" onClick={handleSearch} />
      )}
      {!!searchTerm && (
        <XCircle className="search-sufix" onClick={() => setSearchTerm('')} />
      )}
    </Container>
  );
}

export default Input;
