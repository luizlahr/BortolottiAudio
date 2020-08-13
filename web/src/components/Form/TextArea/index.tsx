import React, {
  InputHTMLAttributes,
  useState,
  useCallback,
  useRef,
  useEffect,
  TextareaHTMLAttributes,
} from 'react';
import { IconBaseProps } from 'react-icons';
import { useField } from '@unform/core';

import { Container } from './styles';

interface ITextAreaProps extends TextareaHTMLAttributes<HTMLTextAreaElement> {
  name: string;
  value?: string;
  icon?: React.ComponentType<IconBaseProps>;
}

const TextArea: React.FC<ITextAreaProps> = ({
  icon: Icon,
  name,
  value,
  rows = 5,
  ...props
}) => {
  const inputRef = useRef<HTMLTextAreaElement>(null);

  const { fieldName, defaultValue, error, registerField } = useField(name);

  const [hasFocus, setHasFocus] = useState(false);
  const [isDirty, setIsDirty] = useState(false);

  useEffect(() => {
    registerField({
      name: fieldName,
      ref: inputRef.current,
      path: 'value',
    });
  }, [fieldName, registerField]);

  const handleBlur = useCallback(() => {
    setHasFocus(false);
    setIsDirty(!!inputRef.current?.value);
  }, []);

  return (
    <Container className="ll-input" hasFocus={hasFocus} isDirty={isDirty}>
      {Icon && <Icon size={20} />}
      <textarea
        className="ll-input ll-input-textarea"
        name={name}
        {...props}
        rows={rows}
        onFocus={() => setHasFocus(true)}
        onBlur={handleBlur}
        ref={inputRef}
        value={value}
        onChange={() => {}}
      />
    </Container>
  );
};

export default TextArea;
