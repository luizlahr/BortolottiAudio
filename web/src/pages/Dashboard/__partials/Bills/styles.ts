import styled, { css } from 'styled-components';
import { Link as AntLink } from 'react-router-dom';

interface ILink {
  active?: number;
}

export const Container = styled.div`
  display: flex;
  width: 100%;
  height: 350px;

  .ll-box {
    overflow: hidden;
    overflow-y: scroll;
  }
`;

export const Table = styled.table`
  width: 100%;

  tr {
    td {
      padding-bottom: 8px;
      color: ${(props) => props.theme.textLight};

      &:nth-child(1) {
        width: 60px;
      }
      &:nth-child(3) {
        text-align: right;
      }
      &:nth-child(4) {
        width: 40px;
        text-align: center;
      }
    }
  }
`;

export const Link = styled(AntLink)<ILink>`
  margin-left: 8px;
  color: ${(props) => props.theme.textLight};

  &:hover {
    color: ${(props) => props.theme.textSelected};
  }

  ${(props) =>
    props.active &&
    css`
      color: ${(props) => props.theme.primary};
    `}
`;
