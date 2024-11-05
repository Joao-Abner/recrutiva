<template>
  <div class="container">
    <div class="container_top_page">
      
      <RouterLink to="/" class="button_sair">
        <ArrowLeft />
      </RouterLink> 
      
      <div class="texto_header">
        <h1>Olá, Recrutador!</h1>
      
      <p>Encontre o seu candidato ideal em empresas comprometidas com o seu futuro.</p>
      </div>
    </div>

    <div class="tabs">
      <RouterLink to="/loginre" class="tab ">JÁ SOU CADASTRADO</RouterLink>
      <RouterLink to="/cadastro" class="tab active">QUERO ME CADASTRAR</RouterLink>
    </div>

    <div class="box-info">
      <form @submit.prevent="handleSubmit" 
      id="registrationForm">
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" name="nome" v-model="formData.firs_name"  placeholder="Nome" required>
        </div>

        <div class="form-group">
          <label for="sobrenome">Sobrenome *</label>
          <input type="text" name="sobrenome" v-model="formData.last_name"  placeholder="Sobrenome" required>
        </div>

        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" name="email" v-model="formData.email"  placeholder="Digite seu Email" required>
        </div>

        <div class="form-group">
          <label for="senha">Senha *</label>
          <input type="password" name="senha" v-model="formData.passowrd"  placeholder="Digite sua senha" required>
        </div>

        <div class="form-group">
          <label for="repetir_senha">Repetir senha *</label>
          <input type="password" name="repetir_senha" v-model="formData.password_confirmation"  placeholder="Repita sua senha" required>
        </div>

        <button type="submit" class="submit-button">EFETUAR CADASTRO</button>
      </form>
    </div>

    <div class="footer">
      <p>Problemas com seu cadastro? <a href="#">Clique para contatar o suporte</a></p>
    </div>
  </div>
</template>

<script>
import { RouterLink } from 'vue-router';
import { ArrowLeft } from 'lucide-vue-next';

export default {
  components: {
    ArrowLeft
  },

    data() {
        return {
            formData: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        };
    },
    methods: {
        handleSubmit() {
            fetch('http://localhost:8001/api/register-recruiter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(this.formData),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
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

.texto_header{
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

.button_sair{
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

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: .9375rem;
  border-radius: .625rem;
}

label {
  margin-bottom: .3125rem;
  font-weight: bold;
}

input, select {
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