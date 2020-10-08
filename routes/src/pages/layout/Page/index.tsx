import React from 'react';
import Crumbs from '../_partials/Crumbs';

import { Container, Title } from './styles';

interface iPage {
  title?: string;
  crumbs?: Array<any>;
  crumbsOff?: boolean;
}

const Page: React.FC<iPage> = ({ children, title, crumbs, crumbsOff }) => {
  return (
    <Container>
      {title && <Title>{title}</Title>}
      {!crumbsOff && <Crumbs crumbs={crumbs} />}
      {children}
    </Container>
  );
};

export default Page;
