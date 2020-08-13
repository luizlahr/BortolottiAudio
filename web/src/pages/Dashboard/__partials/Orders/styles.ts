import styled from 'styled-components';
import { shade } from 'polished';

export const Container = styled.div`
  display: flex;
  justify-content: space-between;
  margin: 0;

  list-style: none;
`;

export const OrderBox = styled.article`
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;

  border-radius: 10px;
  padding: 8px 0;

  background-color: ${(props) => props.theme.secondary};
  transition: all 0.2s;

  &:hover {
    transform: translate(4px, -4px);
    box-shadow: -4px 4px 0px ${(props) => shade(0.1, props.theme.secondary)};
  }

  span {
    color: ${(props) => props.theme.textLight};
  }

  strong {
    font-size: 34px;
  }

  &.quotes {
    strong {
      color: ${(props) => props.theme.warning};
    }
  }

  &.late {
    strong {
      color: ${(props) => props.theme.textDark};
    }
  }

  &.approved {
    strong {
      color: ${(props) => props.theme.primary};
    }
  }

  &.takeout {
    strong {
      color: ${(props) => props.theme.terciary};
    }
  }
`;
