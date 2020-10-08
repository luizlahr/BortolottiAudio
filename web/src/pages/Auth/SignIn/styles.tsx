import styled, { keyframes } from 'styled-components';

const AppearFromLeft = keyframes`
  from {
    opacity: 0;
    transform: translateX(-50px);
  }
  to {
    opacity: 1;
    transform: translateX(0px);
  }
`;

export const Container = styled.main`
  display: flex;
  height: 100%;
`;

export const Logo = styled.h1`
  display: flex;
  margin: 80px 0 60px;
  font-weight: 600;
  font-size: 24px;

  @media screen and (max-width: 770px) {
    margin: 16px 0;
  }
`;

export const UserContent = styled.section`
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 430px;
  overflow-y: auto;

  @media screen and (max-width: 770px) {
    width: 100vw;
  }

  header {
    display: flex;
    margin: 0 40px;

    @media screen and (max-width: 770px) {
      margin: 0 0 40px;
      padding: 0 40px;
      border-bottom: 1px solid #ccc;
    }
  }

  footer {
    display: flex;
    margin: 0 40px;
    flex: 0 1;
    padding: 60px 0;
    font-size: 11px;
    color: #92a0af;
  }
`;

export const UserImage = styled.section`
  display: flex;
  flex: 1;
  background-image: url('https://images.unsplash.com/photo-1540327445742-198f7a2a577f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80');
  background-size: cover;
  background-position: 50%;

  justify-content: center;
  align-items: flex-end;

  @media screen and (max-width: 770px) {
    display: none;
  }

  span {
    display: flex;
    margin-bottom: 30px;
    justify-content: center;
    align-items: center;
    padding: 4px;
    font-size: 12px;

    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 4px;

    a {
      display: flex;
      margin-left: 4px;
      color: #000;
      text-decoration: none;

      &:hover {
        text-decoration: underline;
      }
    }
  }
`;

export const SignInBox = styled.article`
  display: flex;
  flex-direction: column;
  margin: 0 40px;

  animation: ${AppearFromLeft} 1s;

  h1 {
    display: block;
    margin-bottom: 40px;
    font-size: 24px;
    font-weight: 100;
  }

  form {
    display: flex;
    flex-direction: column;
    flex: 1;

    label {
      font-size: 15px;
    }

    .actions {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;

      a {
        display: flex;
        align-items: center;
        text-decoration: none;
        height: 100%;
        color: ${(props) => props.theme.primary};
        transition: color 0.3s;

        &:hover {
          text-decoration: underline;
        }
      }

      button {
        height: 40px;
        width: max-content;
        padding: 0 16px;
        border-radius: 4px;
        border: 1px solid ${(props) => props.theme.primary};
        background: ${(props) => props.theme.primary};
        font-size: 17px;
        font-weight: 600;
        color: #fff;
        text-transform: uppercase;
      }
    }
  }
`;
