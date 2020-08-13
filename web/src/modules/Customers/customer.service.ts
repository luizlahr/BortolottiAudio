import api from 'services/api';
import { toast } from 'react-toastify';

import handler from 'exceptions/handler';
import Customer, { CustomerDataList } from 'modules/Customers/customer.entity';

class CustomerService {
  public async fetch(): Promise<CustomerDataList[] | undefined> {
    try {
      const { data } = await api.get('/customers');
      console.log(data);
      // const customerList = data.map((item: Customer) => {
      //   return new Customer(item).toDataList();
      // });
      return []; //customerList;
    } catch (exception) {
      console.log(exception);
      // handler(exception);
    }
  }

  public async read(id: number): Promise<Customer | undefined> {
    try {
      const { data } = await api.get(`/customers/${id}`);
      return data;
    } catch (exception) {
      handler(exception);
    }
  }

  public async create(
    createCustomerData: Customer,
    utils: any,
  ): Promise<Customer | false> {
    const { setErrors } = utils;

    try {
      const customer = new Customer(createCustomerData);
      await customer.validateCreation();

      await api.post('/customers', customer);
      toast.success('Cliente criado com sucesso!');

      return customer;
    } catch (exception) {
      handler({ exception, params: { setter: setErrors } });
      return false;
    }
  }

  public async update(
    updateUserData: Customer,
    utils: any,
  ): Promise<Customer | false> {
    const { setErrors } = utils;

    try {
      const user = new Customer(updateUserData);
      await user.validateUpdate();

      await api.put(`/customers/${user.id}`, user);
      toast.success('Cliente atualizado com sucesso!');

      return user;
    } catch (exception) {
      handler({ exception, params: { setter: setErrors } });
      return false;
    }
  }

  public async delete(id: number): Promise<void> {
    try {
      await api.delete(`/customers/${id}`);
      toast.success('Cliente removido com sucesso!');
    } catch (exception) {
      handler(exception);
    }
  }
}

export default new CustomerService();
