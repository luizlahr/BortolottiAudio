import axios, { AxiosRequestConfig } from 'axios';
import dotenv from 'dotenv';
import handler from 'exceptions/handler';

dotenv.config();

const api = axios.create({
  baseURL: 'http://localhost:88/api',
  headers: {
    accept: 'application/json',
    'Content-Type': 'application/json',
  },
});

api.interceptors.request.use(
  (config: AxiosRequestConfig) => {
    const token = localStorage.getItem('@BortoAudio:token');

    if (token) {
      config.headers['Authorization'] = `Bearer ${JSON.parse(token)}`;
    }

    return config;
  },
  (error) => {
    Promise.reject(error);
  },
);

export default api;
