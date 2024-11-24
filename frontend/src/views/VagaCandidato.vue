<template>
  <div class="container">
    <div class="container_top_page">
      <!-- Botão para voltar -->
      <RouterLink to="/" class="button_sair">
        <ArrowLeft />
      </RouterLink>

      <div class="texto_header">
        <h1>Conte mais sobre a vaga</h1>
        <p>Digite por gentileza as informações para a vaga</p>
      </div>
    </div>

    <div class="box-info">
      <form @submit.prevent="handleSubmit" id="registrationForm">
        <div class="form-group">
          <label for="title">Título</label>
          <input
            type="text"
            id="title"
            v-model="formData.title"
            placeholder="Título"
            required
          />
        </div>

        <div class="form-group">
          <label for="description">Descrição</label>
          <input
            type="text"
            id="description"
            v-model="formData.description"
            placeholder="Descrição"
            required
          />
        </div>

        <div class="form-group">
          <label for="requirements">Requisitos</label>
          <input
            type="text"
            id="requirements"
            v-model="formData.requirements"
            placeholder="Requisitos"
            required
          />
        </div>

        <div class="form-group">
          <label for="salary">Salário</label>
          <input
            type="number"
            id="salary"
            v-model="formData.salary"
            placeholder="Salário"
            required
          />
        </div>

        <div class="form-group">
          <label for="location">Localização</label>
          <input
            type="text"
            id="location"
            v-model="formData.location"
            placeholder="Localização"
            required
          />
        </div>

        <button type="submit" class="submit-button">Cadastrar para a Vaga</button>
      </form>
    </div>
  </div>
</template>

<script>
import { RouterLink } from "vue-router";
import { ArrowLeft } from "lucide-vue-next";
import axios from "axios";

export default {
  components: {
    ArrowLeft,
  },
  data() {
    return {
      formData: {
        title: "",
        description: "",
        requirements: "",
        salary: "",
        location: "",
      },
    };
  },
  methods: {
    async handleSubmit() {
      try {
        const jobId = 123; // Substituir pelo ID correto da vaga (pode vir de uma rota dinâmica ou ser omitido)
        const response = await axios.post(
          `http://localhost:8001/api/jobs/${jobId}/apply`,
          this.formData,
          {
            headers: {
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          }
        );

        console.log("Vaga cadastrada com sucesso:", response.data);
        alert("Vaga cadastrada com sucesso!");
        this.$router.push("/"); // Redireciona após o sucesso
      } catch (error) {
        console.error("Erro ao cadastrar a vaga:", error.response.data);
        alert("Erro ao cadastrar a vaga. Verifique os dados.");
      }
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 37.5rem;
  margin: auto;
  font-family: "Poppins", sans-serif;
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
  flex-direction: column;
}

.button_sair {
  padding: 0.625rem 1.25rem;
  background-color: #2c3e50;
  cursor: pointer;
  max-width: 4.0625rem;
  border-radius: 0.3125rem;
  color: white;
}

.box-info {
  padding: 1.25rem;
  background-color: #f9f9f9;
  border-radius: 0.5rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 0.9375rem;
  border-radius: 0.625rem;
}

label {
  margin-bottom: 0.3125rem;
  font-weight: bold;
}

input {
  padding: 0.625rem;
  border: 0.0625rem solid #ddd;
  border-radius: 0.25rem;
}

.submit-button {
  width: 100%;
  padding: 0.9375rem;
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
</style>
