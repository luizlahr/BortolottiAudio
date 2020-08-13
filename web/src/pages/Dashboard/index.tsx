import React from 'react';

import { Container, Header } from './styles';
import Row from '../../components/Row';
import Columnn from '../../components/Column';

import SalesChart from './__partials/SalesChart';
import Income from './__partials/Income';
import Movements from './__partials/Movements';
import Bills from './__partials/Bills';
import Orders from './__partials/Orders';
import Main from 'pages/layout/Main';

const Dashboard: React.FC = () => {
  return (
    <Main>
      <Container className="dash-content">
        <Header>
          <Income />
          <Movements />
        </Header>
        <Row>
          <Columnn xs={14}>
            <SalesChart />
          </Columnn>
          <Columnn xs={10}>
            <Bills />
          </Columnn>
        </Row>
        <Row>
          <Columnn xs={24}>
            <Orders />
          </Columnn>
        </Row>
      </Container>
    </Main>
  );
};

export default Dashboard;
