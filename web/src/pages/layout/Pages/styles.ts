import styled from 'styled-components';

export const Container = styled.main`
  display: flex;
  flex-direction: column;
  flex: 1;
`;

export const PageHeaderContainer = styled.header`
  display: flex;
  align-items: center;
  margin-bottom: 70px;

  > h2 {
    display: flex;
    flex: 1;
    margin: 0;
    font-weight: 500;
    font-size: 28px;
    color: ${(props) => props.theme.textSelected};
  }

  .ll-button-add {
    margin-left: 8px;
  }
`;
