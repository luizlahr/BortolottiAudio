import React from 'react';
import AntModal, { ModalFuncProps } from 'antd/lib/modal/Modal';
import 'antd/lib/modal/style/css';

import { ModalStyles } from './styles';
import { FiX } from 'react-icons/fi';
import Footer from './Footer';
import PageLoader from 'components/PageLoader';

interface IModal extends ModalFuncProps {
  visible?: boolean;
  title?: string;
  footer?: React.ReactNode;
  closable?: boolean;
  loading?: boolean;
  onClose?: () => void;
  destroyOnClose?: boolean;
  color?: 'default' | 'primary' | 'danger' | 'success' | 'warning';
}

const Modal: React.FC<IModal> = ({
  title,
  onClose: handleClose,
  closable,
  children,
  visible,
  color,
  className,
  destroyOnClose,
  footer,
  loading,
  ...props
}) => {
  return (
    <>
      <ModalStyles />
      <AntModal
        visible={visible}
        title={title}
        onCancel={handleClose}
        closable={false}
        destroyOnClose={destroyOnClose}
        maskClosable={closable === false ? false : true}
        className={`${className} ${'ll-modal-' + (color ? color : 'default')}`}
        closeIcon={
          <span>
            <FiX size={20} />
          </span>
        }
        footer={footer && <Footer>{footer}</Footer>}
        {...props}
      >
        <PageLoader show={!!loading}></PageLoader>
        {children}
      </AntModal>
    </>
  );
};

export default Modal;
