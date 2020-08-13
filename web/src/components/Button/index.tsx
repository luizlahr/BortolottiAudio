import React, {
  ButtonHTMLAttributes,
  ReactComponentElement,
  ReactElement,
  ReactFragment,
  RefAttributes,
} from 'react';
import Tooltip from 'antd/lib/tooltip';

import { Container, TooltipStyle, Spinner, Bar } from './styles';
import If from '../If';
import { FiLoader } from 'react-icons/fi';

interface ButtonProps extends ButtonHTMLAttributes<HTMLButtonElement> {
  size?: 'small' | 'regular' | 'large';
  color?: 'default' | 'primary' | 'danger' | 'success' | 'warning';
  rounded?: boolean;
  solid?: boolean;
  block?: boolean;
  title?: string;
  loading?: boolean;
  showLoading?: boolean;
}

const Button: React.FC<ButtonProps> = ({
  children,
  className,
  size,
  color,
  block,
  title,
  loading,
  showLoading,
  rounded,
  ...props
}) => {
  const classes = className ? `ll-button ${className}` : 'll-button';

  const renderButton = () => {
    return (
      <Container
        className={classes}
        rounded={rounded}
        block={block}
        size={size}
        color={color}
        type="button"
        role="button"
        loading={loading}
        disabled={loading}
        {...props}
      >
        {loading && (showLoading ? <Loading /> : children)}
        {!loading && children}
      </Container>
    );
  };

  return (
    <>
      <TooltipStyle />
      {title && <Tooltip title={title}>{renderButton()}</Tooltip>}
      {!title && renderButton()}
    </>
  );
};

export default Button;

function Loading() {
  return (
    <Spinner className="ll-spinner">
      <Bar className="bar-1" />
      <Bar className="bar-2" />
      <Bar className="bar-3" />
      <Bar className="bar-4" />
      <Bar className="bar-5" />
    </Spinner>
  );
}
