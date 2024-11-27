// src/config/axiosConfig.js
import axios from 'axios';
import store from '../store';

// Configura o interceptor do Axios
axios.interceptors.request.use(
    config => {
        const token = store.state.token; // Acessa o token do Vuex
        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        }
        return config;
    },
    error => {
        return Promise.reject(error);
    }
);

export default axios;