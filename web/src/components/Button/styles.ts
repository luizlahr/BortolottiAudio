import styled, { css, createGlobalStyle } from 'styled-components';
import { shade } from 'polished';
import theme from '../../styles/theme';
import AntTooltip from 'antd/lib/tooltip';

interface ButtonProps {
  size?: 'small' | 'regular' | 'large';
  color?: 'default' | 'primary' | 'danger' | 'success' | 'warning';
  solid?: boolean;
  block?: boolean;
  rounded?: boolean;
  loading?: boolean;
}

const sizes = {
  rounded: {
    small: css`
      height: ${theme.inputSizes.small};
      width: ${theme.inputSizes.small};
      min-height: ${theme.inputSizes.small};
      min-width: ${theme.inputSizes.small};
      font-size: 14px;
    `,
    regular: css`
      height: ${theme.inputSizes.regular};
      width: ${theme.inputSizes.regular};
      min-height: ${theme.inputSizes.regular};
      min-width: ${theme.inputSizes.regular};
    `,
    large: css`
      height: ${theme.inputSizes.large};
      width: ${theme.inputSizes.large};
      min-height: ${theme.inputSizes.large};
      min-width: ${theme.inputSizes.large};
      font-size: 16px;
    `,
  },
  regular: {
    small: css`
      height: ${theme.inputSizes.small};
      padding: 0 12px;
      font-size: 14px;
    `,
    regular: css`
      height: ${theme.inputSizes.regular};
      padding: 0 16px;
    `,
    large: css`
      height: ${theme.inputSizes.large};
      padding: 0 20px;
      font-size: 16px;
    `,
  },
};

const colors = {
  default: {
    flat: css`
      &:hover {
        color: ${(props) => shade(0.2, props.theme.textLight)};
      }
    `,
    solid: css`
      background-color: ${(props) => props.theme.secondary};

      &:hover {
        background-color: ${(props) => shade(0.1, props.theme.secondary)};
      }
    `,
  },

  primary: {
    flat: css`
      color: ${(props) => props.theme.primary};
      &:hover {
        color: ${(props) => shade(0.2, props.theme.primary)};
      }
    `,
    solid: css`
      background-color: ${(props) => props.theme.primary};
      color: ${(props) => props.theme.secondary};
      &:hover {
        background-color: ${(props) => shade(0.1, props.theme.primary)};
      }
    `,
  },

  danger: {
    flat: css`
      color: ${(props) => props.theme.danger};
      &:hover {
        color: ${(props) => shade(0.2, props.theme.danger)};
      }
    `,
    solid: css`
      background-color: ${(props) => props.theme.danger};
      color: ${(props) => props.theme.secondary};
      &:hover {
        background-color: ${(props) => shade(0.1, props.theme.danger)};
      }
    `,
  },

  success: {
    flat: css`
      color: ${(props) => props.theme.success};
      &:hover {
        color: ${(props) => shade(0.2, props.theme.success)};
      }
    `,
    solid: css`
      background-color: ${(props) => props.theme.success};
      color: ${(props) => props.theme.secondary};
      &:hover {
        background-color: ${(props) => shade(0.1, props.theme.success)};
      }
    `,
  },

  warning: {
    flat: css`
      color: ${(props) => props.theme.warning};
      &:hover {
        color: ${(props) => shade(0.2, props.theme.warning)};
      }
    `,
    solid: css`
      background-color: ${(props) => props.theme.warning};
      color: ${(props) => props.theme.secondary};
      &:hover {
        background-color: ${(props) => shade(0.1, props.theme.warning)};
      }
    `,
  },
};

export const TooltipStyle = createGlobalStyle`
  .ant-tooltip-inner {
  min-height: auto;
  padding: 4px 6px;
  font-size: 12px;
}
`;

export const Container = styled.button<ButtonProps>`
  display: flex;
  justify-content: center;
  align-items: center;
  border: 0;
  font-weight: 500;
  /* margin-top: 16px; */
  border-radius: 16px;

  transition: background 0.3s;

  background-color: ${(props) => props.theme.secondary};
  color: ${(props) => props.theme.textLight};

  &:hover {
    background-color: ${(props) => shade(0.1, props.theme.secondary)};
  }

  ${(props) =>
    sizes[props.rounded ? 'rounded' : 'regular'][props.size || 'regular']};

  ${(props) =>
    colors[props.color || 'default'][props.solid ? 'solid' : 'flat']};

  ${(props) =>
    props.block
      ? css`
          width: 100%;
        `
      : css`
          width: max-content;
        `}

  ${(props) =>
    props.rounded &&
    css`
      border-radius: 50%;
    `}

  ${(props) =>
    props.loading &&
    css`
      opacity: 0.5;
      pointer-events: none;

      .ll-spinner {
        margin-right: 4px;
      }
    `}
`;

export const Spinner = styled.div`
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 20px;
  text-align: center;
  font-size: 10px;
  z-index: 20;
`;

export const Bar = styled.div`
  background-color: #fff;
  height: 70%;
  width: 4px;
  display: inline-block;
  margin-right: 3px;

  -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
  animation: sk-stretchdelay 1.2s infinite ease-in-out;

  &.bar-2 {
    -webkit-animation-delay: -1.1s;
    animation-delay: -1.1s;
  }

  &.bar-3 {
    -webkit-animation-delay: -1s;
    animation-delay: -1s;
  }

  &.bar-4 {
    -webkit-animation-delay: -0.9s;
    animation-delay: -0.9s;
  }

  &.bar-5 {
    -webkit-animation-delay: -0.8s;
    animation-delay: -0.8s;
  }

  @-webkit-keyframes sk-stretchdelay {
    0%,
    40%,
    100% {
      -webkit-transform: scaleY(1);
    }
    20% {
      -webkit-transform: scaleY(2);
    }
  }

  @keyframes sk-stretchdelay {
    0%,
    40%,
    100% {
      transform: scaleY(1);
      -webkit-transform: scaleY(1);
    }
    20% {
      transform: scaleY(1);
      -webkit-transform: scaleY(2);
    }
  }
`;
