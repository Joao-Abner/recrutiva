<template>
    <div class="container">
    <div class="container_top_page">
      
      <RouterLink to="/" class="button_sair">
        <ArrowLeft />
      </RouterLink> 
      
      <div class="texto_header">
        <h1>Crie aqui sua vaga</h1>
      
      <p>Digite por gentileza as informações sobre a vaga</p>
      </div>
    </div>
    </div>
      
    <div class="box-info">
      <form @submit.prevent="handleSubmit" 
      id="registrationForm">
        <div class="form-group">
          <label for="nome">Titulo</label>
          <input type="text" name="nome" v-model="formData.first_name"  placeholder="Titulo" required>
        </div>

        <div class="form-group">
          <label for="sobrenome">Descrição</label>
          <input type="text" name="sobrenome" v-model="formData.last_name"  placeholder="Descrição" required>
        </div>

        <div class="form-group">
          <label for="email">Requisitos</label>
          <input type="email" name="email" v-model="formData.email"  placeholder="Requisitos" required>
        </div>

        <div class="form-group">
          <label for="senha">Salario</label>
          <input type="password" name="senha" v-model="formData.password"  placeholder="Salario" required>
        </div>

        <div class="form-group">
          <label for="repetir_senha">Localização</label>
          <input type="password" name="repetir_senha" v-model="formData.password_confirmation"  placeholder="Localização" required>
        </div>

        <button type="submit" class="submit-button">EFETUAR CADASTRO DA VAGA</button>
      </form>
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
                email: '',
                password: '',
            }
        };
    },
    methods: {
        handleSubmit() {
            fetch('http://localhost:8001/api/login-recruiter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept' : 'application/json',
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