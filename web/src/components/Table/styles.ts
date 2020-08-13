import 'antd/lib/table/style/css';
import styled, { createGlobalStyle } from 'styled-components';
import { shade } from 'polished';

export const Container = styled.div`
  .ant-table {
    .ant-table-thead > tr > th {
      background-color: transparent;
      color: ${props => props.theme.terciary};
      border-bottom: none;

      &:first-child {
        padding-left: 25px;
      }
    }

    .ant-table-tbody > tr {

      &.ant-table-row:hover > td {
        background-color: ${props => props.theme.secondary}
      }

      > td {
        border-bottom: none;
        color: ${props => props.theme.textSelected};

        small {
          color: ${props => props.theme.terciary}
        }

        &:first-child {
          border-bottom-left-radius: 16px;
          border-top-left-radius: 16px;
          padding-left: 24px;
        }

         &:last-child {
          border-bottom-right-radius: 16px;
          border-top-right-radius: 16px;
          padding-right: 24px;
        }
      }
    }

    small {
      font-size: 14px;
    }
  }
`;

export const ActionContainer = styled.div`
  display: flex;

  .ll-button {
    background-color: transparent;
    padding: 0px 8px;
    height: 30px;

    &+.ll-button {
      margin-left: 4px;
    }
  }
`;
