import * as validator from 'yup';

validator.setLocale({
  mixed: {
    required: 'campo obrigatório',
  },
  string: {
    length: "${path} must be exactly ${length} characters",
    min: 'mínimo ${min} caracteres',
    max: 'máximo ${max} caracteres',
    matches: 'deve atender ao padrão: "${regex}"',
    email: 'e-mail inválido',
    url: 'URL inválida',
    trim: 'não deve conter espaços antes ou depois',
    lowercase: 'deve conter apenas letras minúsculas',
    uppercase: 'deve conter apenas letras maiúsculas',
  },
});

export default validator;
