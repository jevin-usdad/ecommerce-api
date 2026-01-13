import axios from 'axios';

let authToken = sessionStorage.getItem('auth_token');

const api = axios.create({
  baseURL: 'http://localhost:82/api',
  headers: {
    'Content-Type': 'application/json',
  },
});

export const setToken = (token) => {
  authToken = token;
  sessionStorage.setItem('auth_token', token);
};

export const clearToken = () => {
  authToken = null;
  sessionStorage.removeItem('auth_token');
};

api.interceptors.request.use(config => {
  if (authToken) {
    config.headers.Authorization = `Bearer ${authToken}`;
  }
  return config;
});

export default api;
