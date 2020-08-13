import styled, { css } from 'styled-components';

interface LoaderProps {
  show: boolean;
}

export const Container = styled.div<LoaderProps>`
  position: fixed;
  display: none;
  align-items: center;
  justify-content: center;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: ${(props) => props.theme.zLoader};

  pointer-events: none;
  opacity: 0;

  transition: all 0.2s;

  ${(props) =>
    props.show &&
    css`
      display: flex;
      opacity: 1;
      pointer-events: all;
      backdrop-filter: blur(4px);
    `}
`;

export const Overlay = styled.div`
  position: absolute;
  display: flex;
  height: 100%;
  top: 0;
  right: 0;
  left: 0;

  background: rgba(255, 255, 255, 0.2);
  pointer-events: none;
  pointer-events: all;

  z-index: 10;
`;

export const Spinner = styled.div`
  width: 100%;
  height: 30px;
  text-align: center;
  font-size: 10px;
  z-index: 20;
`;

export const Bar = styled.div`
  background-color: ${(props) => props.theme.primary};
  height: 100%;
  width: 7px;
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
