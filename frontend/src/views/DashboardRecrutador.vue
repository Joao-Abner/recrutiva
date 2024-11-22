<template>
  <div class="job-listings">
    <h1>Jobs</h1>

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
      </select>

      <select>
        <option>Select category</option>
      </select>
      <button>Filter</button>
    </div>


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
          <button @click="candidatesJob(job.id)">👤 candidatos</button>
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
      jobs: [],
    };
  },
  methods: {
    async fetchJobs() {
      try {
        const response = await axios.get('http://localhost:8001/api/jobs');
        this.jobs = response.data.data;
      } catch (error) {
        console.error("Erro ao buscar vagas:", error);
      }
    },
    viewJob(id) {
      console.log("Visualizando vaga:", id);
    },
    editJob(id) {
      console.log("Editando vaga:", id);
    },
    deleteJob(id) {
      console.log("Deletando vaga:", id);
    }
  },
  mounted() {
    this.fetchJobs();
  }
};
</script>

<style scoped>
.job-listings {
  font-family: Arial, sans-serif;
  color: #333;
}

h1 {
  font-size: 24px;
  margin-bottom: 20px;
}

/* Barra de Filtros */
.filters {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}

.filters button,
.filters select {
  padding: 5px 10px;
  border-radius: 3px;
  border: 1px solid #ccc;
  background-color: #e7e7e7;
  cursor: pointer;
}

.job-cards {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
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

.job-card p {
  margin: 5px 0;
  font-size: 14px;
}

.actions {
  display: flex;
  gap: 5px;
  margin-top: 10px;
}

.actions button {
  background-color: #f0f0f0;
  border: none;
  cursor: pointer;
  padding: 5px;
  border-radius: 3px;
  font-size: 12px;
}

.actions button:hover {
  background-color: #e0e0e0;
}
</style>
