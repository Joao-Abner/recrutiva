<template>
  <div class="container">
    <div class="container_top_page">
      <RouterLink to="/" class="button_sair">
        <ArrowLeft />
      </RouterLink>

      <div class="texto_header">
        <h1>Olá, Candidato!</h1>

        <p>Encontre a sua vaga.</p>
      </div>
    </div>

    <div class="tabs">
      <RouterLink to="/loginca" class="tab active">JÁ SOU CADASTRADO</RouterLink>
      <RouterLink to="/cadastro" class="tab">QUERO ME CADASTRAR</RouterLink>
    </div>
    <div class="form-container">
      <form @submit.prevent="handleSubmit">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" v-model="formData.email" placeholder="Digite seu Email" required>
        </div>
        <div class="form-group">
          <label for="password">Senha</label>
          <input type="password" v-model="formData.password" placeholder="Digite sua senha" required>
        </div>
        <button type="submit" class="submit-button">EFETUAR LOGIN</button>
      </form>
      <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
    </div>

    <div class="footer">
      <RouterLink to="/loginre" class="users-links">
        Clique para acessar como Recrutador
      </RouterLink>
    </div>
  </div>
</template>

<script>
import { RouterLink } from 'vue-router';
import { ArrowLeft } from 'lucide-vue-next';
import { mapActions } from 'vuex';

import axios from 'axios';

export default {
  components: {
    ArrowLeft
  },
  data() {
    return {
      formData: {
        email: '',
        password: '',
      },
      errorMessage: '',
    };
  },
  methods: {
    ...mapActions(['loginCandidate']), // Mapeia a ação de login do Vuex

    async handleSubmit() {
      try {
        await this.loginCandidate(this.formData); // Chama a ação de login
        console.log('Role:', this.$store.getters.role); // Verifica o papel do usuário
        if (this.$store.getters.role !== 'candidate') {
          throw new Error('Usuário não é um candidato');
        }
        this.$router.push('/dashcandidato'); // Redireciona após login bem-sucedido
      } catch (error) {
        console.error("Erro ao fazer login:", error);
        alert('Falha ao efetuar login. Verifique suas credenciais.');
      }
    },
  },
};

</script>


<style>
.container {
  max-width: 37.5rem;
  margin: auto;
  font-family: 'poppins', sans-serif;
  color: #333;
}

.container_top_page {
  text-align: center;
  background-color: #f02424;
  padding: 1.25rem;
  color: white;
  display: flex;
  flex-direction: column;
}

.texto_header {
  display: flex;
  flex-direction: column
}

.tabs {
  display: flex;
  justify-content: center;
  margin: 1.25rem 0;
}

.tab {
  background: none;
  border: none;
  font-weight: bold;
  color: #333;
  padding: .625rem 1.25rem;
  cursor: pointer;
}

.tab.active {
  border-bottom: .125rem solid #f02424;
}

.button_sair {
  padding: .625rem 1.25rem;
  background-color: #2c3e50;
  cursor: pointer;
  max-width: 4.0625rem;
  border-radius: .3125rem;
  color: white
}

.box-info {
  padding: 1.25rem;
  background-color: #f9f9f9;
  border-radius: .5rem;
}

.form-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: .9375rem;
  border-radius: .625rem;
}

.error-message {
  margin-top: 1rem;
  color: red;
}

label {
  margin-bottom: .3125rem;
  font-weight: bold;
}

input,
select {
  padding: .625rem;
  border: .0625rem solid #ddd;
  border-radius: .25rem;
}

.submit-button {
  width: 100%;
  padding: .9375rem;
  background-color: #2c3e50;
  color: white;
  font-size: 1rem;
  font-weight: bold;
  border: none;
  border-radius: 1.25rem;
  cursor: pointer;
}

.submit-button:hover {
  background-color: #333;
}

.footer {
  text-align: center;
  margin-top: 1.25rem;
}

.footer a {
  color: #f02424;
  text-decoration: none;
}

.footer a:hover {
  text-decoration: underline;
}


.terms input {
  margin-right: .625rem;
}
</style>