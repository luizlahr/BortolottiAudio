import styled, { css } from 'styled-components';

export const MenuContainer = styled.ul`
  position: relative;
  display: flex;
  flex-direction: column;
  overflow: hidden;

  list-style: none;

  li {
    display: block;
    overflow: hidden;

    > ul {
      display: flex;
      flex-direction: column;
      max-height: 0;
      opacity: 0;

      transition: max-height 0.4s, opacity 0.3s;
      padding-left: 16px;
    }

    &.open {
      span {
        color: ${props => props.theme.textDark};
      }

      ul {
        max-height: 10em;
        opacity: 1;
        transition: max-height 0.4s, opacity 0.3s;
      }
    }

    &.active {
     > a, span {
        color: ${props => props.theme.textDark};
      }
    }

    a, > span {
      display: flex;
      flex: 1;
      cursor: pointer;

      padding: 8px 16px;
      color: ${props => props.theme.textLight};

      &:hover {
        color: ${props => props.theme.textDark};
      }
    }
  }
`;

// export const MenuContainer = styled.div`
//   display: flex;
//   flex-direction: column;
//   margin: 0;
//   list-style: none;

//   li {
//     display: flex;
//   }
// `;

// export const MenuItem = styled.li<IMenuItemLink>`

//   a, > span {
//     display: flex;
//     flex :1;
//     color: ${(props) => props.theme.textLight};
//     text-decoration: none;

//     padding: 8px 16px;
//     transition: all 0.2s;

//     &:hover {
//       color: ${(props) => props.theme.textDark} !important;
//     }

//     ${(props) => props.active && css`
//         color: ${(props) => props.theme.textDark};
//     `}
//   }
// `;

// export const SubMenuContainer = styled.ul<ISubMenu>`
//   display: none;

//   ${props => props.open && css`
//     display:flex;
//   `}
// `;
