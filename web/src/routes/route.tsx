import React from 'react';
import { Route as DomRoute, Redirect } from 'react-router-dom';
import { RouteProps as DomRouteProps } from 'react-router';
import { useAuth } from 'hooks/auth.hook';

interface RouteProps extends DomRouteProps {
  isPrivate?: boolean;
  isGuest?: boolean;
  component: React.ComponentType;
}

const Route: React.FC<RouteProps> = ({
  component: Component,
  isPrivate,
  isGuest,
  ...props
}) => {
  const { logged } = useAuth();

  return (
    <DomRoute
      render={() => {
        if (isPrivate && !logged) {
          return <Redirect to="/login" />;
        }

        if (isGuest && logged) {
          return <Redirect to="/" />;
        }

        return <Component />;
      }}
    />
  );
};
export default Route;
