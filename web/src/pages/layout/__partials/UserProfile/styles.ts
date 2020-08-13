import styled from 'styled-components';
import theme from 'styles/theme';

export const Container = styled.div`
  display: flex;
  flex-direction: column;
  width: 100%;
  justify-content: center;
  align-items: center;
  margin: 40px 0;

  img {
    max-width: 100%;
    height: 60px;
    width: 60px;
    border-radius: 50%;
    border: 1px solid #ccc;
    overflow: hidden;
    margin-bottom: 16px;
  }

  span {
    display: flex;
    align-items: center;
    color: ${(props) => props.theme.textLight};
    cursor: pointer;

    &.ant-dropdown-open {
      color: ${(props) => props.theme.primary};

      svg {
        transform: rotate(180deg);
      }
    }

    svg {
      margin-left: 8px;
      transition: transform 0.4s;
    }
  }
`;

export const UserProfileMenu = styled.ul`
  display: flex;
  flex-direction: column;
  background: #fff;
  padding: 16px 24px;

  border-radius: 10px;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.07);

  list-style: none;

  & > li {
    & + li {
      margin-top: 8px;
    }

    & > a {
      display: flex;
      font-size: 15px;
      align-items: center;
      color: ${(props) => props.theme.textLight};

      &:hover {
        color: ${(props) => props.theme.textSelected};
      }

      svg {
        margin-right: 8px;
      }
    }
  }
`;
