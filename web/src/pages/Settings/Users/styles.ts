import { createGlobalStyle } from 'styled-components';
import theme from 'styles/theme';

export const TagStyle = createGlobalStyle`
  .ant-tag-green {
    border-color: ${theme.success};
    background-color: ${theme.success};
    color: #fff;
    border-radius: 6px;
  }

  .ant-tag-red {
    border-color: ${theme.danger};
    background-color: ${theme.danger};
    color: #fff;
    border-radius: 6px;
  }
`;
