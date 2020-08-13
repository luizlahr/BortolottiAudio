import styled from 'styled-components';
import theme from '../../../styles/theme'

interface IDivider {
  color?: 'default' | 'primary' | 'danger' | 'success' | 'warning';
}

const colors = {
  default: theme.textSelected,
  primary: theme.primary,
  danger: theme.danger,
  success: theme.success,
  warning: theme.warning
}

export const Container = styled.div<IDivider>`
  position:relative;
  display: flex;
  align-items: center;
  width: 100%;
  margin: 8px 0 0px;
  padding:0;

  &::after {
    content:'';
    display: flex;
    flex: 1;
    border-top: 1px solid #e5e5e5;
  }

  span {
    display: flex;
    margin-right: 16px;
    color: ${props => colors[props.color || "default"]};
    font-size: 18px;
    font-weight: 300;
  }
`;
