import React from 'react';

import { Container, Title, TitleContainer } from './styles';

interface IBox {
  background?: string;
  height?: number | string;
  width?: number | string;
  title?: string;
  titleAction?: string | React.FC;
}

const Box: React.FC<IBox> = ({
  children,
  background,
  title,
  titleAction,
  height,
  width,
}) => {
  return (
    <Container
      background={background}
      height={height}
      width={width}
      className="ll-box"
    >
      {title && (
        <TitleContainer>
          {title && (
            <Title>
              {title}
              {titleAction &&
                (typeof titleAction === 'function'
                  ? React.createElement(titleAction)
                  : titleAction)}
            </Title>
          )}
        </TitleContainer>
      )}

      {children}
    </Container>
  );
};

export default Box;
