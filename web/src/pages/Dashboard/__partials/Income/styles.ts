import styled from 'styled-components';

export const Container = styled.div`
  display: flex;
  flex: 1;
  flex-direction: column;

  h3 {
    display: flex;
    margin-bottom: 24px;
    font-size: 14px;
    font-weight: 500px;
    color: ${(props) => props.theme.textLight};

    strong {
      color: ${(props) => props.theme.textSelected};
    }
  }
`;

export const ValueBoxContainer = styled.div`
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;

  strong {
    display: flex;
    margin-bottom: 16px;
    font-family: 'Ubuntu', Arial, Helvetica, sans-serif;
    font-weight: 500;
    font-size: 24px;
    color: ${(props) => props.theme.textSelected};
  }

  span {
    display: flex;
    margin-bottom: 16px;
    font-family: 'Ubuntu', Arial, Helvetica, sans-serif;
    font-weight: 300;
    font-size: 14px;
    color: ${(props) => props.theme.textLight};
  }
`;

export const InfoWrapper = styled.div`
  display: flex;
  justify-content: space-between;
`;

export const Divider = styled.div`
  display: flex;
  content: '';
  min-height: 100%;
  width: 1px;
  background-color: rgba(159, 159, 178, 0.2);
`;
