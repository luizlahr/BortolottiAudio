import React from 'react';

import utils from 'utils';

import { Container, ValueBoxContainer, InfoWrapper, Divider } from './styles';

interface IValueBox {
  title: string;
  value: number;
}

const Income: React.FC = () => {
  const ValueBox = ({ title, value }: IValueBox) => {
    return (
      <ValueBoxContainer className="ll-value-box-container">
        <strong>{utils.formatValue(value)}</strong>
        <span>{title}</span>
      </ValueBoxContainer>
    );
  };

  return (
    <Container>
      <h3>
        <strong>Financeiro:&nbsp;</strong>
        Entrada
      </h3>
      <InfoWrapper>
        <ValueBox title="Atrasados" value={70} />
        <Divider />
        <ValueBox title="Orçamentos" value={50} />
        <Divider />
        <ValueBox title="Total Recebido" value={350} />
      </InfoWrapper>
    </Container>
  );
};

export default Income;
