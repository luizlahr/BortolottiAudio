import styled from 'styled-components';

export const Container = styled.main`
  display: flex;
  width: 100vw;
  height: 100vh;
`;

export const UserContent = styled.section`
  display: flex;
  flex-direction: column;

  overflow-y: auto;
  
  width: 430px;
  height: 100%;

  padding: 0 24px;

  header { 
    display: flex;
    padding: 80px 0 60px;
  }

  footer {
    display: flex;
    align-items: center;

    padding: 60px 0 40px;

    span { 
      font-size: 12px;
      color: #aaa;
    }
  }
`;

export const UserImage = styled.section`
  display : flex;
  flex: 1; 

  background-color: #ccc;
`;

export const Logo = styled.h1`
  display: flex;

  font-family: 'Ubuntu', sans-serif;
  font-size: 32px;
`;

export const SingInContent = styled.article`
  display: flex;
  flex-direction: column;
  justify-content: center;
  flex: 1;

  h2 { 
    display:flex;
    font-size: 24px;
    margin-bottom: 32px;
  }
`;

export const SignInActions = styled.div`
  display: flex;
  align-items: center;
  
  a { 
    display: flex;
    flex: 1;
    justify-content: flex-start;

    height: 100%;
    text-decoration: none;
    color: ${props => props.theme.textLight};
    
    transition: all 0.3s ease;

    &:hover {
      color: ${props => props.theme.primary};
      text-decoration: underline;
    }
  }
`;

