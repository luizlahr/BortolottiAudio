import React from 'react';
import { Link } from 'react-router-dom';
import { ArrowRight } from 'react-feather';

import { Container } from './styles';

interface iItem {
  label: string;
  url?: string;
}

interface iCrumbs {
  crumbs?: Array<iItem>;
}

const Crumbs: React.FC<iCrumbs> = ({ crumbs }) => {
  const renderCrumbs = () => {
    return crumbs?.map((item: iItem) => {
      if (item.url) {
        return (
          <li key={item.label}>
            <Link to={item.url}>{item.label}</Link>
            <ArrowRight className="crumb-sufix" />
          </li>
        );
      }
      return (
        <li key={item.label}>
          <span>{item.label}</span>
          <ArrowRight className="crumb-sufix" />
        </li>
      );
    });
  };

  return (
    <Container>
      <li>
        Você está aqui:
        <Link to="/">Home</Link>
        <ArrowRight className="crumb-sufix" />
      </li>
      {renderCrumbs()}
    </Container>
  );
};

export default Crumbs;
