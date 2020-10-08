import React from 'react';

import { Routes as Router } from 'react-router-dom';
import Route from 'routes/route';
import Login from 'pages/Auth/SignIn';
import Home from 'pages/Home';
import Customers from 'pages/People/Customers';
import CreateCustomers from 'pages/People/Customers/create';
import UpdateCustomers from 'pages/People/Customers/update';

function Routes() {
  return (
    <Router>
      <Route path="/login" element={<Login />} isGuest />

      <Route path="/" element={<Home />} isAuth />
      <Route path="/teste" element={<Home />} isAuth />
      <Route path="/people/customers" element={<Customers />} isAuth />
      <Route
        path="/people/customers/create"
        element={<CreateCustomers />}
        isAuth
      />
      <Route
        path="/people/customers/:customerId"
        element={<UpdateCustomers />}
        isAuth
      />
    </Router>
  );
}

export default Routes;
