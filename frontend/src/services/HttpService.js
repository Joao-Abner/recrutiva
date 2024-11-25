import axios from "axios";

const HttpService = axios.create({
  baseURL: "http://localhost:8001/api",
  headers: {
    "Content-type": "application/json",
  },
});

// // Interceptor para adicionar o token Bearer a todas as requisições
// HttpService.interceptors.request.use(config => {
//   const token = localStorage.getItem('token'); // Obtém o token do localStorage
//   if (token) {
//     config.headers['Authorization'] = `Bearer ${token}`; // Adiciona o token ao cabeçalho
//   }
//   return config;
// }, error => {
//   return Promise.reject(error);
// });

export const registerUser = async (userData) => {
  try {
    const response = await api.post('/register', userData);
    return response.data;
  } catch (error) {
    throw error.response ? error.response.data : error.message;
  }
};

export default HttpService;


