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
      <RouterLink to="/loginre" class="tab">JÁ SOU CADASTRADO</RouterLink>
      <RouterLink to="/cadastrore" class="tab active">QUERO ME CADASTRAR</RouterLink>
    </div>

    <div class="box-info">
      <form @submit.prevent="handleSubmit" id="registrationForm">

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" v-model="formData.email" placeholder="Digite seu Email" required>
        </div>

        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" name="senha" v-model="formData.password" placeholder="Digite sua senha" required>
        </div>

        <!-- <RouterLink to="/dashrecrutador" class="tab">Efetuar Login</RouterLink> -->
        <button type="submit" class="tab">Efetuar Login</button>
      </form>
    </div>

    <div class="footer">
      <RouterLink to="/loginca" class="users-links">
        Clique para acessar como Candidato
      </RouterLink>
    </div>
  </div>
</template>

<script>
import { RouterLink } from 'vue-router';
import { ArrowLeft } from 'lucide-vue-next';
import { mapActions } from 'vuex';

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
    ...mapActions(['loginRecruiter']), // Mapeia a ação de login do Vuex

    async handleSubmit() {
      try {
        await this.loginRecruiter(this.formData); // Chama a ação de login
        if (this.$store.getters.role !== 'recruiter') {
          throw new Error('Usuário não é um recrutador');
        }
          this.$router.push('/dashrecrutador'); // Redireciona após login bem-sucedido
      } catch (error) {
        console.error("Erro ao fazer login:", error);
        alert('Falha ao efetuar login. Verifique suas credenciais.');
      }
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

input,
select {
  padding: .625rem;
  border: .0625rem solid #ddd;
  border-radius: .25rem;
}

.users-links {
  color: #f02424;
  text-decoration: none;
  cursor: pointer;
}

.users-links:hover {
  text-decoration: underline;
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