import React, { useState, useEffect } from 'react';
import Box from '../../../../components/Box';
import theme from '../../../../styles/theme';

import { Container, Table, Link } from './styles';
import utils from 'utils';
import { FiEye } from 'react-icons/fi';

interface IBill {
  id: string;
  due_to: string;
  name: string;
  value: number;
}

interface IBills {
  income: IBill[];
  outcome: IBill[];
}

const Bills: React.FC = () => {
  const [active, setActive] = useState<0 | 1>(0);
  const [bills, setBills] = useState<IBills>({ income: [], outcome: [] });
  const [tableData, setTableData] = useState<IBill[]>([]);

  useEffect(() => {
    const outcome = [
      {
        id: '1',
        due_to: '10/05',
        name: 'Aluguel',
        value: 800,
      },
      {
        id: '2',
        due_to: '10/05',
        name: 'Aluguel',
        value: 800,
      },
      {
        id: '3',
        due_to: '10/05',
        name: 'Aluguel',
        value: 800,
      },
      {
        id: '4',
        due_to: '10/05',
        name: 'Aluguel',
        value: 800,
      },
      {
        id: '5',
        due_to: '10/05',
        name: 'Aluguel',
        value: 800,
      },
      {
        id: '6',
        due_to: '10/05',
        name: 'Aluguel',
        value: 800,
      },
      {
        id: '7',
        due_to: '10/05',
        name: 'Aluguel',
        value: 800,
      },
    ];

    const income = [
      {
        id: '1',
        due_to: '10/05',
        name: 'Ordem # 0001',
        value: 800,
      },
      {
        id: '2',
        due_to: '10/05',
        name: 'Ordem # 0002',
        value: 800,
      },
      {
        id: '3',
        due_to: '10/05',
        name: 'Ordem # 0003',
        value: 800,
      },
      {
        id: '4',
        due_to: '10/05',
        name: 'Ordem # 0004',
        value: 800,
      },
      {
        id: '5',
        due_to: '10/05',
        name: 'Ordem # 0005',
        value: 800,
      },
      {
        id: '6',
        due_to: '10/05',
        name: 'Ordem # 0006',
        value: 800,
      },
      {
        id: '7',
        due_to: '10/05',
        name: 'Ordem # 0007',
        value: 800,
      },
    ];

    setBills({ income, outcome });
  }, []);

  useEffect(() => {
    if (active === 0) {
      setTableData(bills.outcome);
      return;
    }

    setTableData(bills.income);
  }, [active, bills]);

  const handleTabs = (tab: 0 | 1) => {
    setActive(tab);
  };

  const Title: React.FC = () => {
    return (
      <>
        <Link
          to="/"
          active={Number(active === 0)}
          onClick={() => handleTabs(0)}
        >
          Pagar
        </Link>
        <Link
          to="/"
          active={Number(active === 1)}
          onClick={() => handleTabs(1)}
        >
          Receber
        </Link>
      </>
    );
  };

  const renderTable = (bill: IBill) => {
    return (
      <tr key={bill.id}>
        <td>{bill.due_to}</td>
        <td>{bill.name}</td>
        <td>{utils.formatValue(bill.value)}</td>
        <td>
          <Link to="/">
            <FiEye />
          </Link>
        </td>
      </tr>
    );
  };

  return (
    <Container>
      <Box
        background={theme.secondary}
        title="Proximas Contas"
        titleAction={Title}
        height={350}
      >
        <Table>
          <tbody>{tableData.map(renderTable)}</tbody>
        </Table>
      </Box>
    </Container>
  );
};

export default Bills;
