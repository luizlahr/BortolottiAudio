import React, { useCallback } from 'react';
import Yup from 'utils/yup';
import 'antd/es/table/style/css';

import Layout from 'pages/layout/Main';
import Page from 'pages/layout/Page';
import CustomerForm, { iCustomerForm } from './form';

const crumbs = [
  { label: 'Cadastros' },
  { label: 'Clientes', url: '/people/customers' },
  { label: 'Novo' },
];

const customerSchema = Yup.object().shape({
  email: Yup.string().email().required(),
});

export default function CreateCustomers() {
  const onSubmit = useCallback(async (data: iCustomerForm) => {
    console.log(data);
  }, []);

  return (
    <Layout>
      <Page title="Novo Cliente" crumbs={crumbs}>
        <CustomerForm onSubmit={onSubmit} validationSchema={customerSchema} />
      </Page>
    </Layout>
  );
}
