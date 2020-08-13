import api from 'services/api';
import { toast } from 'react-toastify';

import handler from 'exceptions/handler';
import User, { UserDataList } from 'modules/Users/user.entity';

class UserService {
  public async fetch(): Promise<UserDataList[] | undefined> {
    try {
      const { data } = await api.get('/users');
      const userList = data.map((item: User) => {
        return new User(item).toDataList();
      });
      return userList;
    } catch (exception) {
      handler({ exception });
    }
  }

  public async read(id: number): Promise<User | undefined> {
    try {
      const { data } = await api.get(`/users/${id}`);
      return data;
    } catch (exception) {
      handler({ exception });
    }
  }

  public async create(createUserData: User, utils: any): Promise<User | false> {
    const { setErrors } = utils;

    try {
      const user = new User(createUserData);
      await user.validateCreation();

      await api.post('/users', user);
      toast.success('Usuário criado com sucesso!');

      return user;
    } catch (exception) {
      handler({ exception, params: { setter: setErrors } });
      return false;
    }
  }

  public async update(updateUserData: User, utils: any): Promise<User | false> {
    const { setErrors } = utils;

    try {
      const user = new User(updateUserData);
      await user.validateUpdate();

      await api.put(`/users/${user.id}`, user);
      toast.success('Usuário atualizado com sucesso!');

      return user;
    } catch (exception) {
      handler({ exception, params: { setter: setErrors } });
      return false;
    }
  }

  public async delete(id: number): Promise<void> {
    try {
      await api.delete(`/users/${id}`);
      toast.success('Usuário removido com sucesso!');
    } catch (exception) {
      handler({ exception });
    }
  }
}

export default new UserService();
