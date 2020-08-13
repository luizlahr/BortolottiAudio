import React, { useEffect } from 'react';
import { useHistory, useParams, useLocation } from 'react-router-dom';

import 'formik-antd/es/form/style';
import { useAuth } from 'hooks/auth.hook';

const Signout: React.FC = () => {
  const { signOut, logged } = useAuth();
  const navigate = useHistory();
  const useQuery = () => {
    return new URLSearchParams(useLocation().search);
  };

  const query = useQuery();

  useEffect(() => {
    const checkAuth = () => {
      if (!logged) {
        navigate.push('/');
      }
    };

    checkAuth();
    signOut(!!query.get('expired'));
  }, []);

  return <> {'aqui '} Bye Bye !!!</>;
};

export default Signout;
