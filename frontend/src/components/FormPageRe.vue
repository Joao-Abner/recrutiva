<template>
  <div class="container">
    <div class="container_top_page">

      <RouterLink to="/" class="button_sair">
        <ArrowLeft />
      </RouterLink>

      <div class="texto_header">
        <h1>Olá, Recrutador!</h1>

        <p>Encontre o seu candidato ideal.</p>
      </div>
    </div>

    <div class="tabs">
      <RouterLink to="/loginre" class="tab">JÁ SOU CADASTRADO</RouterLink>
      <RouterLink to="/cadastro" class="tab active">QUERO ME CADASTRAR</RouterLink>
    </div>

    <div class="form-container">
      <form @submit.prevent="registerRecruiter">
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" name="nome" v-model="formData.first_name" placeholder="Nome" required>
        </div>

        <div class="form-group">
          <label for="sobrenome">Sobrenome </label>
          <input type="text" name="sobrenome" v-model="formData.last_name" placeholder="Sobrenome" required>
        </div>

        <div class="form-group">
          <label for="email">Email </label>
          <input type="email" name="email" v-model="formData.email" placeholder="Digite seu Email" required>
        </div>

        <div class="form-group">
          <label for="senha">Senha </label>
          <input type="password" name="senha" v-model="formData.password" placeholder="Digite sua senha" required>
        </div>

        <div class="form-group">
          <label for="repetir_senha">Repetir senha </label>
          <input type="password" name="repetir_senha" v-model="formData.password_confirmation"
            placeholder="Repita sua senha" required>
        </div>
        <button type="submit" class="submit-button">EFETUAR CADASTRO</button>
      </form>
      <div v-if="successMessage" class="success-message">{{ successMessage }}</div>
      <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
    </div>

    <div class="footer">
      Problemas com seu cadastro?
      <RouterLink to="/loginca" class="users-links">
        Clique para acessar como Candidato
      </RouterLink>
    </div>
  </div>
</template>

<script>
import { RouterLink } from 'vue-router';
import { ArrowLeft } from 'lucide-vue-next';

import axios from 'axios';

export default {
  components: {
    ArrowLeft
  },

  data() {
    return {
      formData: {
        first_name: '',
        last_name: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      successMessage: '',
      errorMessage: '',
    };
  },
  methods: {
    async registerRecruiter() {
      try {
        console.log(this.formData); // Verifique os dados do formulário
        const response = await axios.post('http://localhost:8001/api/auth/register-recruiter', this.formData);
        console.log('Registro bem-sucedido:', response.data);this.errorMessage = '';
        this.successMessage = 'Registro bem-sucedido! Redirecionando para a página de login...';
        this.errorMessage = '';
        // Limpar o formulário
        this.formData = {
          name: '',
          email: '',
          password: '',
          password_confirmation: '',
        };
        // Redirecionar após um curto atraso
        setTimeout(() => {
          this.$router.push('/loginre');
        }, 3000); // Redireciona após 3 segundos
      } catch (error) {
        if (error.response && error.response.data) {
          this.errorMessage = error.response.data.message || 'Erro ao registrar';
          console.error('Erro ao registrar:', error.response.data);
        } else {
          this.errorMessage = 'Erro ao registrar';
          this.successMessage = '';
          console.error('Erro ao registrar:', error.message);
        }
      }
    },
  }
}

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
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
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
  background-color: #1a252f;
}

.success-message {
  margin-top: 10px;
  color: green;
}

.error-message {
  margin-top: 10px;
  color: red;
}

.footer {
  text-align: center;
  margin-top: .25rem;
  margin-bottom: 3.25rem;
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