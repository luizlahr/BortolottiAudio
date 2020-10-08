import React from 'react';

import { Container } from './styles';
import Layout from 'pages/layout/Main';
import Page from 'pages/layout/Page';

export default function Home() {
  return (
    <Layout>
      <Page crumbsOff={true}>
        <Container>
          <h1>Home Page</h1>
        </Container>
      </Page>
    </Layout>
  );
}
