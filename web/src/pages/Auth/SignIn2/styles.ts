import styled from 'styled-components';

import signInBackground from 'assets/bgSignIn.svg';

export const Container = styled.div`
  display: flex;
  align-items: stretch;

  height: 100%;
  min-height: 100vh;
  margin: 0 24px;

  form {
    width: 100%;
    max-width: 350px;
    text-align: center;

    .ll-form-control + .ll-form-control {
      margin-top: 16px;
    }

    > img {
      margin-bottom: 40px;
    }

    > a {
      display: block;
      color: ${(props) => props.theme.textLight};
      padding: 8px 0;
      margin-top: 24px;
      transition: color 0.3s;
      text-decoration: none;
      text-align: center;

      &:hover {
        color: ${(props) => props.theme.primary};
      }
    }
  }
`;

export const FormWrapper = styled.div`
  display: flex;
  flex-direction: column;
  place-content: center;

  width: 100%;
  max-width: 400px;
  padding: 30px;
  min-height: 100%;

  .logo {
    margin-bottom: 40px;
  }
`;

export const Banner = styled.div`
  flex: 1;
  height: 100vh;
  background: url(${signInBackground}) no-repeat center;
  background-size: 80%;
`;
