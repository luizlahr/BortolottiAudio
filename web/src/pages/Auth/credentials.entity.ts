import * as Yup from 'yup';

export interface CredentialsEntity {
  email: string;
  password: string;
}

export default class Credentials {
  email: string;
  password: string;

  constructor({ email, password }: CredentialsEntity) {
    this.email = email;
    this.password = password;
  }

  public async validate(): Promise<void> {
    const schema = Yup.object().shape({
      email: Yup.string().required().email(),
      password: Yup.string().required(),
    });

    await schema.validate(this, {
      abortEarly: false,
    });
  }
}
