import styled from 'styled-components';

export const Container = styled.div`
  display: flex;
  flex-direction: row-reverse;

  margin: 16px 0 32px;

  .ll-button + .ll-button {
    margin-right: 16px;
  }
`;
