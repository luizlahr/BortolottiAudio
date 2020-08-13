import { createGlobalStyle } from 'styled-components';
import theme from '../../../styles/theme';

export const SwitchStyles = createGlobalStyle`
  .ant-switch {
    width: max-content;
    background-color: ${theme.danger};
  }

  .ant-switch-checked {
    background-color: ${theme.primary};
  }
`;
