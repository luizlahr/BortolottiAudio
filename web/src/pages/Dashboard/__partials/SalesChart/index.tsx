import React from 'react';
import { Bar } from 'react-chartjs-2';
import theme from 'styles/theme';
import Box from 'components/Box';

const data = {
  labels: [
    'Jan',
    'Fev',
    'Mar',
    'Abr',
    'Mai',
    'Jun',
    'Jul',
    'Ago',
    'Set',
    'Out',
    'Nov',
    'Dez',
  ],
  datasets: [
    {
      barPercentage: 0.5,
      barThickness: 'flex',
      backgroundColor: '#dadada',
      hoverBackgroundColor: theme.primary,
      data: [13, 20, 14, 12, 30, 23, 12, 13, 15, 18, 22, 20],
    },
  ],
};

const options = {
  responsive: true,
  maintainAspectRatio: false,
  layout: {
    padding: {
      left: 0,
      right: 0,
      top: 0,
      bottom: 50,
    },
  },
  legend: {
    display: false,
    labels: {
      defaultFontFamily: 'Ubuntu',
    },
  },
  scales: {
    xAxes: [
      {
        display: true,
        gridLines: {
          display: false,
        },
      },
    ],
    yAxes: [
      {
        gridLines: {
          borderDash: [4],
        },
        ticks: {
          beginAtZero: true,
          fontColor: theme.textSelected,
          fontStyle: 'bold',
          callback: function (value: number) {
            return 'R$ ' + value;
          },
        },
      },
    ],
  },
};

const SalesChart: React.FC = () => {
  return (
    <Box background={theme.secondary} height={350} title="Vendas por Mês">
      <Bar data={data} options={options} height={100} />
    </Box>
  );
};

export default SalesChart;
