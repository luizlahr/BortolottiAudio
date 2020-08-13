import React from 'react';
import { Switch } from 'react-router-dom';

import Route from './route';
import NotFoundPage from 'pages/NotFoundPage';
import SignIn from 'pages/Auth/SignIn';
import SignOut from 'pages/Auth/SignOut';
import ForgotPassword from 'pages/Auth/ForgotPassword';
import ResetPassword from 'pages/Auth/ResetPassword';
import Dashboard from 'pages/Dashboard';
import Customers from 'pages/Customers';
import EquipmentCategories from 'pages/Equipments/Categories';
import EquipamentBrands from 'pages/Equipments/Brands';
import EquipamentModels from 'pages/Equipments/Models';
import Orders from 'pages/Orders';
import BillsIncome from 'pages/Bills/Income';
import BillsOutcome from 'pages/Bills/Outcome';
import BillsCategories from 'pages/Bills/Categories';
import Users from 'pages/Settings/Users';
import AccountingMovements from 'pages/Accounting/Movements';
import AccountingBankAccounts from 'pages/Accounting/BankAccounts';

const RoutesDirectory: React.FC = () => {
  return (
    <Switch>
      <Route exact path="/login" component={SignIn} isGuest />
      <Route exact path="/logout" component={SignOut} isPrivate />
      <Route exact path="/password/forgot" component={ForgotPassword} isGuest />
      <Route exact path="/password/reset" component={ResetPassword} isGuest />

      <Route exact path="/" component={Dashboard} isPrivate />
      <Route exact path="/customers" component={Customers} />
      <Route
        exact
        path="/equipments/categories"
        component={EquipmentCategories}
        isPrivate
      />
      <Route
        exact
        path="/equipments/brands"
        component={EquipamentBrands}
        isPrivate
      />
      <Route
        exact
        path="/equipments/models"
        component={EquipamentModels}
        isPrivate
      />
      <Route exact path="/orders" component={Orders} isPrivate />
      <Route exact path="/bills/income" component={BillsIncome} isPrivate />
      <Route exact path="/bills/outcome" component={BillsOutcome} isPrivate />
      <Route
        exact
        path="/bills/categories"
        component={BillsCategories}
        isPrivate
      />
      <Route exact path="/settings/users" component={Users} />
      <Route
        exact
        path="/accounting/movements"
        component={AccountingMovements}
        isPrivate
      />
      <Route exact path="/bank-accounts" component={AccountingBankAccounts} />
      <Route path="*" component={NotFoundPage} />
    </Switch>
  );
};

export default RoutesDirectory;
