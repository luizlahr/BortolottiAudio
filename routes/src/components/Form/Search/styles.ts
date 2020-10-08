import styled, { css } from 'styled-components';
import { lighten } from 'polished'

interface iContainer {
  hasFocus: boolean;
  isDisabled: boolean;
  width?: string;
}

export const Container = styled.div<iContainer>`
  display: flex;
  flex: 1;
  align-items: center;
  height: 40px;
  max-height: 40px;

  border-width: 1px;
  border-style: solid;
  border-color: ${props => props.theme.terciary};
  border-radius: ${props => props.theme.radiusMedium};

  transition: border-color 0.2s linear;
  
  padding: 0 8px 0 16px;
  margin: 4px 0 12px;

  input { 
    display: flex;
    flex: 1;
    justify-content: flex-start;
    align-items: center;
    border: 0;
    font-size: ${props => props.theme.fontSizeInput};

    &:disabled {
      background-color: transparent !important;
    }

    cursor: inherit;
  }

  svg { 
    display: flex;
    height: 20px;
    width: 20px;
    color: ${props => props.theme.textLight};

    cursor: pointer;

    margin-left: 4px;
  }

  ${props => props.width && css`
    max-width: ${props.width} !important;
  `}

  ${props => props.hasFocus && css`
    border-width: 2px;
    border-color: ${props.theme.primary}
  `}

  ${props => props.isDisabled && css`
    background-color: ${lighten(0.09, props.theme.secondary)};
    cursor: not-allowed;
  `}
`;
