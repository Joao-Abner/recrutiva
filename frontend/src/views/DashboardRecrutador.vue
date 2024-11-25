<template>
  <div class="job-listings">
    <header class="header">
      <div class="logo-container">
        <img src="@/assets/logo-recrutiva.png" alt="Logo Recrutiva" class="logo" />
        <h1 class="logo-text">RECRUTIVA</h1>
      </div>
      <button @click="goBack" class="back-button">VOLTAR</button>
    </header>

    <!-- Restante do código -->
    <div class="job-cards">
      <div v-for="job in jobs" :key="job.id" class="job-card">
        <h3>{{ job.title }}</h3>
        <p><strong>Descrição:</strong> {{ job.description }}</p>
        <p><strong>Salário:</strong> R$ {{ job.salary }}</p>
        <p><strong>Localização:</strong> {{ job.location }}</p>
        <p><strong>Requisitos:</strong> {{ job.requirements }}</p>
        <div class="actions">
          <button @click="editJob(job.id)">✏️ Editar</button>
          <button @click="deleteJob(job.id)">🗑️ Deletar</button>
          <button @click="candidatesJob(job.id)">👤 Candidatos</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "JobListings",
  data() {
    return {
      jobs: [],
    };
  },
  methods: {
    // Buscar todas as vagas
    async fetchJobs() {
      try {
        const response = await axios.get("http://localhost:8001/api/jobs");
        this.jobs = response.data.data;
      } catch (error) {
        console.error("Erro ao buscar vagas:", error);
      }
    },

    // Voltar para a página anterior
    goBack() {
      window.history.back();
    },

    // Visualizar vaga
    viewJob(id) {
      console.log("Visualizando vaga:", id);
    },

    // Editar vaga
    async editJob(id) {
      const newTitle = prompt("Digite o novo título da vaga:"); // Exemplo simples de edição
      if (newTitle) {
        try {
          await axios.put(`http://localhost:8001/api/jobs/${id}`, { title: newTitle });
          alert("Vaga atualizada com sucesso!");
          this.fetchJobs(); // Atualiza a lista de vagas após a edição
        } catch (error) {
          console.error("Erro ao editar a vaga:", error);
          alert("Falha ao editar a vaga.");
        }
      }
    },

    // Deletar vaga
    async deleteJob(id) {
      if (confirm("Você tem certeza que deseja deletar esta vaga?")) {
        try {
          await axios.delete(`http://localhost:8001/api/jobs/${id}`);
          alert("Vaga deletada com sucesso!");
          this.fetchJobs(); // Atualiza a lista de vagas após a exclusão
        } catch (error) {
          console.error("Erro ao deletar a vaga:", error);
          alert("Falha ao deletar a vaga.");
        }
      }
    },
  },
  mounted() {
    this.fetchJobs();
  },
};
</script>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: #fff;
  border-bottom: 1px solid #e0e0e0;
}

.logo-container {
  display: flex;
  align-items: center;
  gap: 10px;
}

.logo {
  width: 50px;
  height: auto;
}

.logo-text {
  font-size: 24px;
  font-weight: bold;
  color: #e00000;
}

.back-button {
  font-size: 14px;
  font-weight: bold;
  color: #333;
  background-color: transparent;
  border: 1px solid #e00000;
  border-radius: 5px;
  padding: 8px 15px;
  cursor: pointer;
  text-transform: uppercase;
}

.back-button:hover {
  background-color: #e00000;
  color: #fff;
}

/* Restante do código */
.job-listings {
  font-family: Arial, sans-serif;
  color: #333;
}

.job-cards {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  padding: 20px;
}

.job-card {
  border: 1px solid #e0e0e0;
  border-radius: 5px;
  padding: 15px;
  width: 300px;
  background-color: #f9f9f9;
}

.job-card h3 {
  font-size: 18px;
  color: #007bff;
  margin-bottom: 10px;
}

.actions button {
  padding: 5px;
  border: none;
  background-color: #f0f0f0;
  border-radius: 3px;
  cursor: pointer;
}

.actions button:hover {
  background-color: #e0e0e0;
}
</style>
