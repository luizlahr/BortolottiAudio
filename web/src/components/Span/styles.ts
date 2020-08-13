import styled, { css } from 'styled-components';

interface ISpan {
  direction?: "vertical" | "horizontal";
  full?: 1 | 0;
}

export const Container = styled.span<ISpan>`
  display:flex;
  align-items: center;

  ${props => props.direction === "vertical" && css`
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
  `}

  ${props => props.full && css`
    flex: 1;
  `}
`;
