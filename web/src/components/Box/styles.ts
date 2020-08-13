import styled, { css } from 'styled-components';
import { isNumber } from 'util';

interface IBox {
  background?: string;
  height?: string | number;
  width?: string | number;
}

export const Container = styled.div<IBox>`
  display: flex;
  flex: 1;
  flex-direction: column;
  padding: 24px;

  ${(props) =>
    props.height &&
    css`
      height: ${isNumber(props.height) ? `${props.height}px` : props.height};
    `};

  ${(props) =>
    props.width &&
    css`
      width: ${isNumber(props.width) ? `${props.width}px` : props.width};
    `};

  border-radius: 10px;

  background-color: ${(props) =>
    props.background || props.theme.light.background};
`;

export const Title = styled.h3`
  display: flex;
  font-size: 15px;
  font-weight: 500;
  color: ${(props) => props.theme.textSelected};
`;

export const TitleContainer = styled.header`
  display: flex;
  margin-bottom: 24px;
`;
