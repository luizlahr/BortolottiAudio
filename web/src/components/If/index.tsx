import React from 'react';

// import {Container} from './styles';

interface IIf {
  test: boolean;
}

const If: React.FC<IIf> = (props) => {
  if (props.test) {
    return <>{props.children}</>
  }

  return <></>
};

export default If;
