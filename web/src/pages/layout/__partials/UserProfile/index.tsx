import React from 'react';

import { Container, UserProfileMenu } from './styles';
import { FiChevronDown, FiUser, FiPower } from 'react-icons/fi';
import { Link } from 'react-router-dom';
import Dropdown from 'antd/lib/dropdown';
import 'antd/lib/dropdown/style/css';

import { useAuth } from 'hooks/auth.hook';
import profileImg from 'assets/profile_img.png';

const UserProfile: React.FC = () => {
  const { user } = useAuth();

  const userMenu = (
    <UserProfileMenu>
      <li>
        <Link to="/">
          <FiUser />
          Perfil
        </Link>
      </li>
      <li>
        <Link to="/logout">
          <FiPower />
          Sair
        </Link>
      </li>
    </UserProfileMenu>
  );

  return (
    <Container>
      <img src={profileImg} alt="Profile" />
      <Dropdown overlay={userMenu} placement="bottomCenter">
        <span>
          {user?.name}
          <FiChevronDown />
        </span>
      </Dropdown>
    </Container>
  );
};

export default UserProfile;
