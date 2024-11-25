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
};

// Definindo as ações
const actions = {
  async loginRecruiter({ commit }, credentials) {
    try {
      const response = await axios.post('http://localhost:8001/api/auth/login-recruiter', credentials);
      const token = response.data.access_token; // Obtém o token da resposta
      commit('setToken', token);
      commit('setUser', response.data.user); // Supondo que você tenha um campo user na resposta
      commit('setRole', 'recruiter'); // Define o papel como recrutador
    } catch (error) {
      console.error("Erro ao fazer login como recrutador:", error);
    }
  },

  async loginCandidate({ commit }, credentials) {
    try {
      const response = await axios.post('http://localhost:8001/api/auth/login-candidate', credentials);
      const token = response.data.access_token; // Obtém o token da resposta
      commit('setToken', token);
      commit('setUser', response.data.user); // Supondo que você tenha um campo user na resposta
      commit('setRole', 'candidate'); // Define o papel como candidato
    } catch (error) {
      console.error("Erro ao fazer login como candidato:", error);
    }
  },

  logout({ commit }) {
    commit('setUser', null);
    commit('setToken', null);
    commit('setRole', null); // Limpa o papel do usuário ao fazer logout
  },
};

// Criando a store com persistência
const store = createStore({
  state,
  mutations,
  actions,
  plugins: [createPersistedState()], // Adiciona o plugin para persistência
});

export default store;