import React from "react";
import { RouteProps } from "react-router";
import { Route as DomRoute, Navigate } from "react-router-dom";
import { useAuth } from "hooks/auth";

interface iRoute extends RouteProps {
  isAuth?: boolean;
  isGuest?: boolean;
  redirectTo?: string;
}

function Route({
  element,
  redirectTo,
  isAuth,
  isGuest,
  path,
  ...props
}: iRoute) {
  const { logged } = useAuth();

  if (isAuth && !logged) {
    return <Navigate to="/login" />;
  }

  if (isGuest && logged) {
    return <Navigate to="/" />;
  }

  return <DomRoute path={path} element={element} />;
}

export default Route;
