import React, { createContext, useContext, useState, useCallback } from 'react';
import Modal from 'components/Modal';
import Button from 'components/Button';

interface ConfirmProps {
  title?: string;
  message?: string;
  okText: string;
  cancelText: string;
  color?: 'default' | 'primary' | 'danger' | 'success' | 'warning';
  onOk(): void;
  onCancel(): void;
}

interface ConfirmContextProps {
  confirm(object: ConfirmProps): void;
}

const ConfirmContext = createContext<ConfirmContextProps>(
  {} as ConfirmContextProps,
);

const initialValues: ConfirmProps = {
  title: 'Tem certeza?',
  message: undefined,
  okText: 'Ok',
  cancelText: 'Cancelar',
  color: 'primary',
  onOk: () => {},
  onCancel: () => {},
};

const ConfirmProvider: React.FC = ({ children }) => {
  const [show, setShow] = useState<boolean>(false);
  const [options, setOptions] = useState<ConfirmProps>(initialValues);

  function confirm(options: ConfirmProps): void {
    console.log(options);
    setOptions(options);
    setShow(true);
  }

  const handleClose = useCallback(() => {
    setShow(false);
    options?.onCancel();
  }, []);

  const handleOk = async () => {
    const { onOk } = options;
    await Promise.all([onOk(), setShow(false)]);
  };

  const renderFooter = (
    <>
      <Button solid onClick={handleClose}>
        {options?.cancelText}
      </Button>
      <Button solid onClick={handleOk} color={options?.color}>
        {options?.okText}
      </Button>
    </>
  );

  return (
    <ConfirmContext.Provider value={{ confirm }}>
      <Modal
        visible={show}
        title={options?.title}
        onClose={() => options?.onCancel()}
        closable={false}
        color={options?.color ?? 'primary'}
        footer={renderFooter}
      >
        <span>{options?.message}</span>
      </Modal>
      {children}
    </ConfirmContext.Provider>
  );
};

function useConfirm() {
  const context = useContext(ConfirmContext);

  if (!context) {
    throw new Error('useConfirm must be used within a ConfirmProvider');
  }

  return context;
}

export { useConfirm, ConfirmProvider };
