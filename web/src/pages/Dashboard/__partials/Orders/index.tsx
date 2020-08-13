import React from 'react';

import { OrderBox } from './styles';

import Row from '../../../../components/Row';
import Column from '../../../../components/Column';

const Component: React.FC = () => {
  return (
    <Row>
      <Column xs={6}>
        <OrderBox className="quotes">
          <span>Aguardando Orçamentos</span>
          <strong>18</strong>
        </OrderBox>
      </Column>
      <Column xs={6}>
        <OrderBox className="late">
          <span>Atrasadas</span>
          <strong>4</strong>
        </OrderBox>
      </Column>
      <Column xs={6}>
        <OrderBox className="approved">
          <span>Aprovadas</span>
          <strong>5</strong>
        </OrderBox>
      </Column>
      <Column xs={6}>
        <OrderBox className="takeout">
          <span>Aguardando Retirada</span>
          <strong>3</strong>
        </OrderBox>
      </Column>
    </Row>
  );
};

export default Component;
