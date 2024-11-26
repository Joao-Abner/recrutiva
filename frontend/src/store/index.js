import { createStore } from 'vuex'; // Importa createStore do Vuex
import createPersistedState from 'vuex-persistedstate';
import axios from 'axios';

// Definindo o estado inicial
const state = {
  authUser: null,
  token: null,
  role: null, // Para armazenar o papel do usuário (recrutador ou candidato)
};

// Definindo as mutações
const mutations = {
  setUser(state, user) {
    state.authUser = user;
  },
  setToken(state, token) {
    state.token = token;
  },
  setRole(state, role) {
    state.role = role; // Armazena o papel do usuário
  },
  CLEAR_TOKEN(state) {
    state.authUser = null;
    state.token = null;
    state.role = null;
  },
};

// Definindo as ações
const actions = {
  async loginRecruiter({ commit }, credentials) {
    try {
      const response = await axios.post('http://localhost:8001/api/auth/login-recruiter', credentials);
      const token = response.data.access_token; // Obtém o token da resposta
      const user = response.data.user;
      const role = response.data.role;

      commit('setToken', token);
      commit('setUser', user);
      commit('setRole', role); // Define o papel como recrutador


      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    } catch (error) {
      console.error("Erro ao fazer login como recrutador:", error);
    }
  },

  async loginCandidate({ commit }, credentials) {
    try {
      const response = await axios.post('http://localhost:8001/api/auth/login-candidate', credentials);
      const token = response.data.access_token; // Obtém o token da resposta
      const user = response.data.user;
      const role = response.data.role;

      commit('setToken', token);
      commit('setUser', user);
      commit('setRole', role); // Define o papel como candidato


      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    } catch (error) {
      console.error("Erro ao fazer login como candidato:", error);
    }
  },

  logout({ commit }) {
    commit('CLEAR_TOKEN');
    delete axios.defaults.headers.common['Authorization'];
  },
};

// Definindo os getters
const getters = {
  authUser: state => state.authUser,
  token: state => state.token,
  role: state => state.role,
};

// Criando a store com persistência
const store = createStore({
  state,
  mutations,
  actions,
  getters,
  plugins: [createPersistedState()], // Adiciona o plugin para persistência
});

export default store;