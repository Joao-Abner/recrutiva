<template>
  <div class="job-listings">
    <header class="header">
      <div class="logo-container">
        <img src="@/assets/logo-recrutiva.png" alt="Logo Recrutiva" class="logo" />
        <h1 class="logo-text">RECRUTIVA</h1>
      </div>
      <div class="header-actions">
        <button @click="logout" class="back-button">SAIR</button>
      </div>
    </header>

    <div class="job-cards">
      <div v-for="job in jobs" :key="job.id" class="job-card">
        <h3>{{ job.title }}</h3>
        <p><strong>Descrição:</strong> {{ job.description }}</p>
        <p><strong>Salário:</strong> R$ {{ job.salary }}</p>
        <p><strong>Localização:</strong> {{ job.location }}</p>
        <p><strong>Requisitos:</strong> {{ job.requirements }}</p>
        <div class="actions">
          <button @click="acceptJob(job.id)">✅ Aceitar Trabalho</button>
          <button @click="deleteJob(job.id)">🗑️ Excluir</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";

export default {
  name: "DashBoardCandidato",
  data() {
    return {
      jobs: [],
      loading: false,
    };
  },
  computed: {
    ...mapGetters(["authUser", "token"]),
  },
  methods: {
    async fetchJobs() {
      this.loading = true;
      try {
        const response = await axios.get("http://localhost:8001/api/jobs", {
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
        });
        this.jobs = response.data.data;
      } catch (error) {
        console.error("Erro ao buscar vagas:", error);
        alert("Falha ao buscar vagas.");
      } finally {
        this.loading = false;
      }
    },

    async handleLogout() {
      await this.logout();
      this.$router.push('/loginre');
    },
    async acceptJob(jobId) {
      if (confirm("Você tem certeza que deseja se inscrever nesta vaga?")) {
        try {
          const response = await axios.post(
            `http://localhost:8001/api/jobs/${jobId}/apply`,
            {},
            {
              headers: {
                Authorization: `Bearer ${this.token}`,
              },
            }
          );
          alert(response.data.message || "Inscrição realizada com sucesso!");
          this.fetchJobs();
        } catch (error) {
          console.error("Erro ao se inscrever na vaga:", error);
          alert(
            error.response?.data?.message || "Falha ao se inscrever na vaga."
          );
        }
      }
    },
    deleteJob(jobId) {
      if (confirm("Você tem certeza que deseja remover esta vaga da visualização?")) {
        // Remove a vaga da lista de jobs visualmente
        this.jobs = this.jobs.filter(job => job.id !== jobId);
        alert("Vaga removida da visualização.");
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

.header-actions {
  display: flex;
  gap: 10px;
}

.add-button {
  font-size: 14px;
  font-weight: bold;
  color: #fff;
  background-color: #f44336;
  border: none;
  border-radius: 5px;
  padding: 8px 15px;
  cursor: pointer;
  text-transform: uppercase;
}

.add-button:hover {
  background-color: #e00000;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  width: 400px;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.modal-actions {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}

.modal-actions button {
  padding: 5px 10px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

.modal-actions button:first-child {
  background-color: #f44336;
  color: #fff;
}

.modal-actions button:last-child {
  background-color: #f44336;
  color: #fff;
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
  justify-content: center;
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
  color: #f44336;
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
