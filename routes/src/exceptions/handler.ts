import { ValidationError } from 'yup';
import { toast } from 'react-toastify';
import HttpCode from 'http-status-codes';
import history from 'history/browser';

interface HandlerParamsProps {
  setter: any;
}

interface HandlerProps {
  exception: any;
  params?: HandlerParamsProps;
}

const renderValidationError = (
  errors: Array<ValidationError>,
  callback?: any,
) => {
  if (callback) {
    const errorMessages: { [key: string]: string } = {};
    errors.forEach((item: ValidationError) => {

      errorMessages[item.path] = item.message;
    });
    callback(errorMessages);
  }
};

const renderUnexpectedError = () => {
  toast.error('Ocorreu um erro inesperado! Tente novamente mais tarde');
};

const renderUnauthorizedError = (message: string) => {
  if (message === 'unauthenticated') {
    toast.error('Por favor, autentique-se novamente!');
    history.push('/logout?expired=true');
    return;
  }
};

const renderBadRequestValidation = ({ response }: any) => {
  toast.error(response.data.message);
};

export default ({ exception, params = undefined }: HandlerProps) => {
  const response = exception['response'] ?? null;

  console.log(exception);
  console.log(response);

  if (response && HttpCode.UNAUTHORIZED === response.status) {
    renderUnauthorizedError(response.data.message ?? null);
    return;
  }

  if (exception instanceof ValidationError) {
    renderValidationError(exception.inner, params?.setter);
    return;
  }

  if (response && HttpCode.BAD_REQUEST === exception.response.status) {
    renderBadRequestValidation(exception);
    return;
  }

  renderUnexpectedError();
};
