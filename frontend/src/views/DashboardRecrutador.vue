<template>
  <div class="job-listings">
    <h1>Jobs</h1>

    <!-- Barra de Filtros -->
    <div class="filters">
      <button>All ({{ jobs.length }})</button>
      <button>Published (7)</button>
      <button>Draft (1)</button>
      <button>Trash (10)</button>
      <button>Expired (1)</button>

      <select>
        <option>Bulk Actions</option>
        <option>Delete</option>
        <option>Publish</option>
      </select>
      <button>Apply</button>

      <select>
        <option>All dates</option>
        <!-- Add more date options if needed -->
      </select>

      <select>
        <option>Select category</option>
        <!-- Add more categories if needed -->
      </select>
      <button>Filter</button>
    </div>

    <!-- Exibição das Vagas em "Caixas" -->
    <div class="job-cards">
      <div v-for="job in jobs" :key="job.id" class="job-card">
        <h3>{{ job.title }}</h3>
        <p><strong>Descrição:</strong> {{ job.description }}</p>
        <p><strong>Salário:</strong> R$ {{ job.salary }}</p>
        <p><strong>Localização:</strong> {{ job.location }}</p>
        <p><strong>Requisitos:</strong> {{ job.requirements }}</p>
        <div class="actions">
          <button @click="viewJob(job.id)">👁️ Ver</button>
          <button @click="editJob(job.id)">✏️ Editar</button>
          <button @click="deleteJob(job.id)">🗑️ Deletar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "JobListings",
  data() {
    return {
      jobs: [], // Array para armazenar as vagas
    };
  },
  methods: {
    async fetchJobs() {
      try {
        const response = await axios.get('http://localhost:8001/api/jobs'); // URL da sua API
        this.jobs = response.data.data; // Acessa os dados da resposta
      } catch (error) {
        console.error("Erro ao buscar vagas:", error);
      }
    },
    viewJob(id) {
      // Lógica para visualizar detalhes da vaga
      console.log("Visualizando vaga:", id);
    },
    editJob(id) {
      // Lógica para editar a vaga
      console.log("Editando vaga:", id);
    },
    deleteJob(id) {
      // Lógica para deletar a vaga
      console.log("Deletando vaga:", id);
    }
  },
  mounted() {
    this.fetchJobs(); // Chama a função ao montar o componente
  }
};
</script>

<style scoped>
/* Estilo básico das caixas */
.job-cards {
  display: flex;
  flex-wrap: wrap;
}

.job-card {
  border: 1px solid #e0e0e0;
  border-radius: 5px;
  padding: 15px;
  margin: 10px;
  width: calc(33% - 20px); /* Três cards por linha */
}

.actions button {
  margin-right: 5px;
}
</style>