import React from 'react';

// import {Container} from './styles';
import { Routes as Router } from 'react-router-dom';
import Route from 'routes/route';
import Home from 'pages/Home';
import Login from 'pages/Auth/SignIn';

function Routes() {
  return (
    <Router>
      <Route path="/" element={<Home />} isAuth />
      <Route path="/teste" element={<Home />} isAuth />
      <Route path="/login" element={<Login />} isGuest />
    </Router>
  );
}

export default Routes;
