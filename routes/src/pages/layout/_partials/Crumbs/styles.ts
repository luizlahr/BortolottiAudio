import styled from 'styled-components';
import { lighten } from 'polished';


export const Container = styled.ul`
  display: flex;
  list-style: none;
  
  background-color: ${props => lighten(0.1, props.theme.secondary)};
  border-radius: ${props => props.theme.radiusSmall};
  padding: 4px 16px;

  margin-bottom: 24px;

  li { 
    display: flex;
    justify-content: flex-start;
    align-items: center;
    font-size: 14px;

    &:last-child {
      a,span{
        color: ${props => props.theme.textDark};
      }

      .crumb-sufix {
        display: none;
      }
    }

    svg {
      display: flex;
        width: 16px;
        height: 16px;
    }

    a { 
      text-decoration: underline;
    }

    a,span {
      display:flex;
      padding: 0 8px 0 4px;

      color: ${props => props.theme.textLight};

      svg { 
        display: flex;
        width: 16px;
        height: 16px;
        margin-right: 4px;
      }
    }

    a:hover {
      color: ${props => props.theme.primary};
    }

    .crumb-sufix {
      color: ${props => props.theme.textLight};
    }

  }
`;
