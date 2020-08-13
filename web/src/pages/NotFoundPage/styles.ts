import styled from 'styled-components';

export const Container = styled.div`
  display: flex;
  flex-direction: column;
  flex: 1;
  min-height: 100vh;
  justify-content: center;
  align-items: center;
  color: ${(props) => props.theme.textLight};

  h2 {
    font-size: 40px;
    margin-bottom: 40px;
  }

  h3 {
    margin-top: 40px;
  }
`;
