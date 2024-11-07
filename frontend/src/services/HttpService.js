import axios from "axios";

const HttpService = axios.create({
  baseURL: "http://localhost:8001/",
  headers: {
    "Content-type": "application/json",
  },
});

export const registerUser = async (userData) => {
  try {
    const response = await api.post('/register', userData);
    return response.data;
  } catch (error) {
    throw error.response ? error.response.data : error.message;
  }
};

export default HttpService;


