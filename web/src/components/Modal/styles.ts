import styled, { createGlobalStyle } from 'styled-components';
import theme from '../../styles/theme'

interface ModalProps {
  color?: 'default' | 'primary' | 'danger' | 'success' | 'warning';
}

export const ModalStyles = createGlobalStyle<ModalProps>`
  .ant-modal-content {
    border-radius: 16px;
    max-width: 100%;
    margin-left: 20px;
    margin-right: 20px;
    overflow: hidden;
  }

  .ant-modal-header {
    border-bottom: none;
    padding: 24px 30px 10px;

    .ant-modal-title {
      font-size: 21px;
    }
  }

  .ant-modal-body {
    padding: 30px;
  }

  .ant-modal-footer {
    background-color: transparent;
    padding: 16px 30px;

    button {
      border-radius: 16px;

      .ant-btn-primary {
        background-color: ${theme.primary};
        border-color: ${theme.primary};
      }
    }
  }

  .ant-modal-close {
    top: 8px;

    .ant-modal-close-x {
      display:flex;
      justify-content: center;
      align-items: center;

      span {
        display:flex;
        width: max-content;
        padding: 4px;
        border-radius: 50%;
        transition: background 0.3s;

        &:hover {
          background-color: ${theme.secondary};
        }
      }
    }
  }

  .ll-modal-default {
    .ant-modal-title {
      color: ${props => theme.textSelected};
    }
  }

  .ll-modal-primary {
    .ant-modal-title {
      color: ${props => theme.primary};
    }
  }

  .ll-modal-danger {
    .ant-modal-title {
      color: ${props => theme.danger};
    }
  }

  .ll-modal-success {
    .ant-modal-title {
      color: ${props => theme.success};
    }
  }

  .ll-modal-warning {
    .ant-modal-title {
      color: ${props => theme.warning};
    }
  }
`;

export const FooterContainer = styled.footer`
  display: flex;
  flex: 1;
  justify-content: flex-end;
`;
