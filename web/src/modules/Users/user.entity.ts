import * as Yup from 'yup';

interface UserEntity {
  id?: number;
  name?: string;
  email?: string;
  password?: string;
  passwordConfirm?: string;
  activeText?: string;
  active?: boolean;
}

interface UserState {
  inactive: string;
  active: string;
}

export const UserStates: UserState = {
  inactive: 'Inativo',
  active: 'Ativo',
};

export interface UserDataList {
  key: number;
  name: string;
  email: string;
  active: string;
}

export default class User {
  id?: number;
  name?: string;
  email?: string;
  password?: string;
  passwordConfirm?: string;
  active?: boolean;

  constructor({
    id,
    name,
    email,
    password,
    passwordConfirm,
    active,
  }: UserEntity) {
    this.id = id;
    this.name = name;
    this.email = email;
    this.password = password;
    this.passwordConfirm = passwordConfirm;
    this.active = active;
  }

  public async validateCreation(): Promise<void> {
    const schema = Yup.object().shape({
      name: Yup.string().required(),
      email: Yup.string().required().email(),
      password: Yup.string().required().min(6),
      passwordConfirm: Yup.string()
        .equals([Yup.ref('password')], 'as senhas são diferentes')
        .required(),
    });

    await schema.validate(this, {
      abortEarly: false,
    });
  }

  public async validateUpdate(): Promise<void> {
    const schema = Yup.object().shape({
      name: Yup.string().required(),
      email: Yup.string().required().email(),
    });

    await schema.validate(this, {
      abortEarly: false,
    });
  }

  public toDataList(): UserDataList {
    return {
      key: Number(this.id),
      name: this.name ?? '',
      email: this.email ?? '',
      active: this.active ? UserStates.active : UserStates.inactive,
    };
  }
}
