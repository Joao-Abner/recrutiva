import { createStore } from 'vuex'; // Importa createStore do Vuex
import createPersistedState from 'vuex-persistedstate';

// Definindo o estado inicial
const state = {
  authUser: null,
  token: null,
};

// Definindo as mutações
const mutations = {
  setUser(state, user) {
    state.authUser = user;
  },
  setToken(state, token) {
    state.token = token;
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
    } catch (error) {
      console.error("Erro ao fazer login:", error);
    }
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