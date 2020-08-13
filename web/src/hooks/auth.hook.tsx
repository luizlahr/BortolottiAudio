import React, { createContext, useCallback, useState, useContext } from 'react';
import api from '../services/api';
import { useHistory } from 'react-router-dom';
import User from 'modules/Users/user.entity';
import handler from 'exceptions/handler';

interface stateDTO {
  logged: boolean;
  user: User | null;
  token: string | null;
}

interface CredentialsProps {
  email: string;
  password: string;
}

interface AuthContextProps {
  logged: boolean;
  user: User | null | undefined;
  token: string | null | undefined;
  signIn(credentials: CredentialsProps, callback: any): Promise<void>;
  signOut(expired: boolean): void;
}

const AuthContext = createContext<AuthContextProps>({} as AuthContextProps);

const AuthProvider: React.FC = ({ children }) => {
  const [data, setData] = useState<stateDTO>(() => {
    const logged = localStorage.getItem('@BortoAudio:logged');
    const user = localStorage.getItem('@BortoAudio:user');
    const token = localStorage.getItem('@BortoAudio:token');

    if (user && logged) {
      return {
        user: JSON.parse(user),
        token: token,
        logged: logged !== 'false',
      };
    }

    return {} as stateDTO;
  });

  const history = useHistory();

  const signIn = useCallback(
    async ({ email, password }: CredentialsProps, callback: any = null) => {
      try {
        const { data } = await api.post('/auth', { email, password });
        const { user, token } = data;

        localStorage.setItem('@BortoAudio:user', JSON.stringify(user));
        localStorage.setItem('@BortoAudio:token', JSON.stringify(token));
        localStorage.setItem('@BortoAudio:logged', JSON.stringify(true));

        setData({ user, token, logged: true });
      } catch (exception) {
        handler({ exception, params: { setter: callback } });
      }
    },
    [],
  );

  const signOut = useCallback(async (expired: boolean = false) => {
    setData({ user: null, token: null, logged: false });

    localStorage.removeItem('@BortoAudio:user');
    localStorage.removeItem('@BortoAudio:token');
    localStorage.setItem('@BortoAudio:logged', JSON.stringify(false));

    if (!expired) {
      api.delete('/auth');
    }

    history.push('/login');
  }, []);

  return (
    <AuthContext.Provider
      value={{
        user: data.user,
        token: data.token,
        logged: data.logged,
        signIn,
        signOut,
      }}
    >
      {children}
    </AuthContext.Provider>
  );
};

function useAuth(): AuthContextProps {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuth must be used within an AuthProvider');
  }

  return context;
}

export { useAuth, AuthProvider };
