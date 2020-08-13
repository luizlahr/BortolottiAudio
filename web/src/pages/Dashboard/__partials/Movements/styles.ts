import styled from 'styled-components';

interface IGraphBar {
  value: number;
}

export const Container = styled.div`
  display: flex;
  flex: 1;
  flex-direction: column;
  margin-left: 50px;

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
    color: ${(props) => props.theme.textDark};
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

export const GraphContainer = styled.div`
  display: flex;
  justify-content: space-between;

  strong {
    display: flex;
    margin-bottom: 16px;
    font-family: 'Ubuntu', Arial, Helvetica, sans-serif;
    font-weight: 500;
    font-size: 24px;
    color: ${(props) => props.theme.textSelected};
  }
`;

export const Graph = styled.ul`
  display: flex;
  flex: 1;
  flex-direction: column;
  list-style: none;
  margin-right: 24px;

  li + li {
    margin-top: -4px;
  }

  li:first-child {
    background-color: ${(props) => props.theme.primary};
  }

  li:last-child {
    background-color: ${(props) => props.theme.warning};
    opacity: 0.8;
  }
`;

export const GraphBar = styled.li<IGraphBar>`
  display: flex;
  height: 16px;
  min-width: 20px;

  width: ${(props) => props.value}%;

  &:hover {
    &:first-child {
      box-shadow: 0px 0px 4px ${(props) => props.theme.primary};
    }

    &:last-child {
      box-shadow: 0px 0px 4px ${(props) => props.theme.warning};
    }
  }
`;

export const Legend = styled.ul`
  display: flex;
  list-style: none;

  li + li {
    margin-left: 16px;
  }

  li {
    position: relative;
    display: flex;
    padding-left: 30px;
    font-weight: 300;
    color: ${(props) => props.theme.textLight};

    &:first-child::before {
      background-color: ${(props) => props.theme.primary};
    }

    &:last-child::before {
      background-color: ${(props) => props.theme.warning};
    }

    &::before {
      content: '';
      position: absolute;
      display: flex;
      background-color: #ccc;
      height: 3px;
      width: 24px;

      top: 49%;
      left: 0;
    }
  }
`;
