<template>
  <div class="job-listings">
    <header class="header">
      <div class="logo-container">
        <img src="@/assets/logo-recrutiva.png" alt="Logo Recrutiva" class="logo" />
        <h1 class="logo-text">RECRUTIVA</h1>
      </div>
      <div class="header-actions">
        <button @click="logout" class="back-button">SAIR</button>
        <button @click="showAddModal = true" class="add-button">ADICIONAR</button>
      </div>
    </header>

    <!-- Modal de Adicionar Vaga -->
    <div v-if="showAddModal" class="modal">
      <div class="modal-content">
        <h2>Adicionar Nova Vaga</h2>
        <label>
          Título:
          <input v-model="newJob.title" type="text" />
        </label>
        <label>
          Descrição:
          <textarea v-model="newJob.description"></textarea>
        </label>
        <label>
          Salário:
          <input v-model="newJob.salary" type="number" />
        </label>
        <label>
          Localização:
          <input v-model="newJob.location" type="text" />
        </label>
        <label>
          Requisitos:
          <textarea v-model="newJob.requirements"></textarea>
        </label>
        <div class="modal-actions">
          <button @click="addJob">Salvar</button>
          <button @click="showAddModal = false">Cancelar</button>
        </div>
      </div>
    </div>

    <!-- Modal de Editar Vaga -->
    <div v-if="showEditModal" class="modal">
      <div class="modal-content">
        <h2>Editar Vaga</h2>
        <label>
          Título:
          <input v-model="editJobData.title" type="text" />
        </label>
        <label>
          Descrição:
          <textarea v-model="editJobData.description"></textarea>
        </label>
        <label>
          Salário:
          <input v-model="editJobData.salary" type="number" />
        </label>
        <label>
          Localização:
          <input v-model="editJobData.location" type="text" />
        </label>
        <label>
          Requisitos:
          <textarea v-model="editJobData.requirements"></textarea>
        </label>
        <div class="modal-actions">
          <button @click="updateJob">Salvar</button>
          <button @click="showEditModal = false">Cancelar</button>
        </div>
      </div>
    </div>

    <!-- Lista de Vagas -->
    <div class="job-cards">
      <div v-for="job in jobs" :key="job.id" class="job-card">
        <h3>{{ job.title }}</h3>
        <p><strong>Descrição:</strong> {{ job.description }}</p>
        <p><strong>Salário:</strong> R$ {{ job.salary }}</p>
        <p><strong>Localização:</strong> {{ job.location }}</p>
        <p><strong>Requisitos:</strong> {{ job.requirements }}</p>
        <div class="actions">
          <button @click="openEditModal(job)">✏️ Editar</button>
          <button @click="deleteJob(job.id)">🗑️ Deletar</button>
          <button @click="candidatesJob(job.id)">👤 Candidatos</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapState } from 'vuex'; // Importa mapState para acessar o estado do Vuex
import axios from "axios";
import { mapActions } from "vuex";

export default {
  name: "DashBoardRecrutador",
  data() {
    return {
      jobs: [],
      showAddModal: false,
      showEditModal: false,
      newJob: {
        title: "",
        description: "",
        salary: null,
        location: "",
        requirements: "",
      },
      editJobData: {
        id: null,
        title: "",
        description: "",
        salary: null,
        location: "",
        requirements: "",
      },
      loading: false, // Estado de carregamento
    };
  },
  computed: {
    ...mapGetters(['authUser', 'token', 'role']),
  },
  methods: {
    ...mapActions(["logoutAction"]),

    async fetchJobs() {
      this.loading = true; // Inicia o carregamento
      console.log(this.token);
      try {
        const response = await axios.get("http://localhost:8001/api/my-jobs", {
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
        });
        this.jobs = response.data.data;
      } catch (error) {
        console.error("Erro ao buscar vagas:", error);
        alert("Falha ao buscar vagas."); // Você pode substituir por uma notificação
      } finally {
        this.loading = false; // Finaliza o carregamento
      }
    },

    goBack() {
      window.history.back();
    },

    viewJob(id) {
      this.$router.push({ name: 'JobDetails', params: { id } }); // Redireciona para a página de detalhes da vaga
    },

    async editJob(job) {
      const updatedJob = {
        title: prompt("Digite o novo título da vaga:", job.title),
        description: prompt("Digite a nova descrição da vaga:", job.description),
        salary: prompt("Digite o novo salário da vaga:", job.salary),
        location: prompt("Digite a nova localização da vaga:", job.location),
        requirements: prompt("Digite os novos requisitos da vaga:", job.requirements),
      };

      if (Object.values(updatedJob).some((field) => field === null || field.trim() === '')) {
        alert("Edição cancelada. Todos os campos devem ser preenchidos.");
        return;
      }

      try {
        await axios.put(`http://localhost:8001/api/my-jobs/${job.id}`, updatedJob);
        alert("Vaga atualizada com sucesso!");
        this.fetchJobs();
      } catch (error) {
        console.error("Erro ao realizar logout:", error);
      }
    },
    async addJob() {
      try {
        await axios.post("http://localhost:8001/api/my-jobs/create", this.newJob);
        alert("Vaga adicionada com sucesso!");
        this.showAddModal = false;
        this.newJob = { title: "", description: "", salary: null, location: "", requirements: "" };
        this.fetchJobs();
      } catch (error) {
        console.error("Erro ao adicionar vaga:", error);
        alert("Falha ao adicionar a vaga.");
      }
    },
    openEditModal(job) {
      this.editJobData = { ...job };
      this.showEditModal = true;
    },
    async updateJob() {
      try {
        await axios.put(`http://localhost:8001/api/jobs/${this.editJobData.id}`, this.editJobData);
        alert("Vaga atualizada com sucesso!");
        this.showEditModal = false;
        this.fetchJobs();
      } catch (error) {
        console.error("Erro ao atualizar vaga:", error);
        alert("Falha ao atualizar a vaga.");
      }
    },
    async deleteJob(id) {
      if (confirm("Você tem certeza que deseja deletar esta vaga?")) {
        try {
          await axios.delete(`http://localhost:8001/api/my-jobs/${id}`, {
          headers: {
            Authorization: `Bearer ${this.token}`,
          },
        });
          alert("Vaga deletada com sucesso!");
          this.fetchJobs();
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
