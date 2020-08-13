import React from 'react';

import utils from 'utils';

import { Container, Graph, GraphBar, GraphContainer, Legend } from './styles';

interface IValueBox {
  title: string;
  value: number;
}

const Movements: React.FC = () => {
  return (
    <Container>
      <h3>
        <strong>Movimentações:&nbsp;</strong>
        Mês
      </h3>
      <GraphContainer>
        <Graph>
          <GraphBar value={100} />
          <GraphBar value={50} />
        </Graph>
        <strong>{utils.formatValue(325)}</strong>
      </GraphContainer>
      <Legend>
        <li>Entrada</li>
        <li>Saída</li>
      </Legend>
    </Container>
  );
};

export default Movements;
