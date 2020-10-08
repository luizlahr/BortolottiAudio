import React from 'react';

import Email from 'components/Form/Email';
import Input from 'components/Form/Input';
import Button from 'components/Button';
import Row from 'components/Grid/Row';
import Col from 'components/Grid/Col';
import FormControl from 'components/Form/FomControl';
import FormActions from 'components/Form/Actions';
import { Controller, useForm, UseFormMethods } from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers';
import { ObjectSchema, Shape } from 'yup';

export interface iCustomerForm {
  business: string;
  name: string;
  nickname: string;
  mobile: string;
  phone: string;
  email: string;
  ssn: string;
  nid: string;
  zipcode: string;
  street: string;
  streetNumber: string;
  neighborhood: string;
  city: string;
  state: string;
}

interface iForm {
  onSubmit(data: iCustomerForm): Promise<void>;
  validationSchema: ObjectSchema;
}

const CustomerForm: React.FC<iForm> = ({ onSubmit, validationSchema }) => {
  const { handleSubmit, errors, control } = useForm<iCustomerForm>({
    resolver: yupResolver(validationSchema),
  });

  return (
    <form onSubmit={handleSubmit(onSubmit)}>
      <Col span={24}>
        <h2>Dados Pessoais</h2>
      </Col>
      <Row>
        <Col span={6}>
          <FormControl label="Pessoa" error={errors?.business?.message}>
            <Controller
              name="business"
              autoFocus
              control={control}
              as={Input}
              defaultValue="física"
            />
          </FormControl>
        </Col>

        <Col span={12}>
          <FormControl label="Nome" error={errors?.name?.message}>
            <Controller
              name="name"
              control={control}
              as={Input}
              defaultValue=""
            />
          </FormControl>
        </Col>

        <Col span={6}>
          <FormControl label="Apelido" error={errors?.nickname?.message}>
            <Controller
              name="nickname"
              control={control}
              as={Input}
              defaultValue=""
            />
          </FormControl>
        </Col>

        <Col span={8}>
          <FormControl label="Celular" error={errors?.mobile?.message}>
            <Controller
              name="mobile"
              control={control}
              as={Input}
              defaultValue=""
            />
          </FormControl>
        </Col>

        <Col span={8}>
          <FormControl label="Telefone" error={errors?.phone?.message}>
            <Controller
              name="phone"
              control={control}
              as={Input}
              defaultValue=""
            />
          </FormControl>
        </Col>

        <Col span={8}>
          <FormControl label="E-mail" error={errors?.email?.message}>
            <Controller
              name="email"
              control={control}
              as={Email}
              defaultValue=""
            />
          </FormControl>
        </Col>

        <Col span={12}>
          <FormControl label="CPF" error={errors?.ssn?.message}>
            <Controller
              name="ssn"
              control={control}
              as={Input}
              defaultValue=""
            />
          </FormControl>
        </Col>

        <Col span={12}>
          <FormControl label="RG" error={errors?.nid?.message}>
            <Controller
              name="nid"
              control={control}
              as={Input}
              defaultValue=""
            />
          </FormControl>
        </Col>

        <Col span={24}>
          <h2>Endereço</h2>
        </Col>

        <Col span={4}>
          <FormControl label="CEP" error={errors?.zipcode?.message}>
            <Controller
              name="zipcode"
              control={control}
              as={Input}
              defaultValue=""
            />
          </FormControl>
        </Col>

        <Col span={16}>
          <FormControl label="Endereço" error={errors?.street?.message}>
            <Controller
              name="street"
              control={control}
              as={Input}
              defaultValue=""
            />
          </FormControl>
        </Col>

        <Col span={4}>
          <FormControl label="Número" error={errors?.streetNumber?.message}>
            <Controller
              name="streetNumber"
              control={control}
              as={Input}
              defaultValue=""
            />
          </FormControl>
        </Col>

        <Col span={8}>
          <FormControl label="Bairro" error={errors?.neighborhood?.message}>
            <Controller
              name="neighborhood"
              control={control}
              as={Input}
              defaultValue=""
            />
          </FormControl>
        </Col>

        <Col span={12}>
          <FormControl label="Cidade" error={errors?.city?.message}>
            <Controller
              name="city"
              control={control}
              as={Input}
              defaultValue=""
            />
          </FormControl>
        </Col>

        <Col span={4}>
          <FormControl label="Estado" error={errors?.state?.message}>
            <Controller
              name="state"
              control={control}
              as={Input}
              defaultValue=""
            />
          </FormControl>
        </Col>
      </Row>
      <FormActions>
        <Button color="primary" role="submit">
          Adicionar
        </Button>
        <Button>Cancelar</Button>
      </FormActions>
    </form>
  );
};

export default CustomerForm;
