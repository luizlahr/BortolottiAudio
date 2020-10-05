import React, {
  createContext,
  useCallback,
  useContext,
  useState,
  useEffect,
} from "react";
import handler from "exceptions/handler";
import api from "services/api";
import { useNavigate } from "react-router-dom";

interface iCredentials {
  email: string;
  password: string;
}

interface iUser {
  id: number;
  name: string;
  email: string;
}

interface iAuth {
  logged: boolean;
  user: iUser | null;
  token: string | null;
  signUserIn(credentials: iCredentials, callback: any): void;
  signUserOut(): void;
}

const localStoragePrefix = "@BortoSystem";

const AuthContext = createContext<iAuth>({} as iAuth);

export const AuthProvider: React.FC = ({ children }) => {
  const navigate = useNavigate();

  const setTokenString = useCallback((value: string | null) => {
    const key = `${localStoragePrefix}:token`;
    if (!value) {
      localStorage.removeItem(key);
    } else {
      localStorage.setItem(key, value);
    }
  }, []);

  const setUserString = useCallback((value: iUser | null) => {
    const key = `${localStoragePrefix}:user`;
    if (!value) {
      localStorage.removeItem(key);
    } else {
      localStorage.setItem(key, JSON.stringify(value));
    }
  }, []);

  const getTokenString = useCallback(() => {
    return localStorage.getItem(`${localStoragePrefix}:token`);
  }, []);

  const getUserString = useCallback((): iUser | null => {
    const value = localStorage.getItem(`${localStoragePrefix}:user`);

    if (!value) {
      return null;
    }

    return JSON.parse(value);
  }, []);

  const [logged, setLogged] = useState<boolean>(() => {
    const hasUser = getUserString();
    const hasToken = getTokenString();

    if (hasUser !== null && hasToken !== null) {
      return true;
    }

    return false;
  });
  const [user, setUser] = useState<iUser | null>(() => {
    return getUserString();
  });
  const [token, setToken] = useState<string | null>(() => {
    return getTokenString();
  });

  useEffect(() => {
    setUserString(user);
  }, [user, setUserString]);

  useEffect(() => {
    setTokenString(token);
  }, [token, setTokenString]);

  const signUserIn = useCallback(
    async (credentials: iCredentials, callback: any = null) => {
      try {
        const { data } = await api.post("/auth", credentials);

        const { email, name, id } = data.user;

        setUser({ id, name, email });
        setToken(data.token);
        setLogged(true);

        navigate("/");
      } catch (exception) {
        setLogged(false);
        handler({ exception, params: { setter: callback } });
      }
    },
    [navigate]
  );

  const signUserOut = () => {
    setToken(null);
    setUser(null);
    setLogged(false);

    navigate("/login");
  };

  return (
    <AuthContext.Provider
      value={{
        logged,
        user,
        token,
        signUserIn,
        signUserOut,
      }}
    >
      {children}
    </AuthContext.Provider>
  );
};

export function useAuth() {
  const context = useContext(AuthContext);

  if (!context) {
    throw new Error("useAuth must be used within a AuthProvider");
  }

  return context;
}
