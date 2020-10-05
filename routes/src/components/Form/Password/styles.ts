import styled, { css } from 'styled-components';

interface iContainer {
  hasFocus: boolean;
}

export const Container = styled.div<iContainer>`
  display: flex;
  flex: 1;
  height: 40px;

  border-width: 1px;
  border-style: solid;
  border-color: ${props => props.theme.terciary};
  border-radius: ${props => props.theme.radiusMedium};
  
  padding: 0 16px; 
  margin: 4px 0 12px;

  transition: border-color 0.2s linear;

  input { 
    display: flex;
    flex: 1;
    justify-content: flex-start;
    align-items: center;

    font-size: ${props => props.theme.fontSizeInput};

    border: 0;
  }

  ${props => props.hasFocus && css`
    border-width: 2px;
    border-color: ${props.theme.primary}
  `}
`;

interface iSuffix {
  showPass: boolean;
}

export const Suffix = styled.span<iSuffix>`
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
  width: 20px;
  margin-left: 8px;

  svg {
    height: 20px;
    width: 20px;
    color: #aaa;

    cursor: pointer;

    &:hover {
      color: #3af;
    }

    &.hide { opacity: 0; pointer-events: none;}
    &.show { opacity: 1; pointer-events: all;}

    &.show, &.hide {
      position: absolute;
      transition: opacity 0.3s ease;
    }

    ${props => props.showPass && css`
      &.show { opacity: 0; pointer-events: none;}
      &.hide { opacity: 1; pointer-events: all;}
    `}
  }
`;
