<template>
  <div class="homepage">
      <header class="header">
          <img src="@/assets/logo-recrutiva.png" alt="Logo-recrutiva" class="logo" />
          <h1 class="logo-text">RECRUTIVA</h1>
          <div class="dropdown">
              <button class="login-button" @click="toggleDropdown">
                  ACESSAR/CADASTRAR <span class="arrow">▼</span>
              </button>
              <div v-if="isDropdownVisible" class="dropdown-menu">
                  <RouterLink to="/cadastro" class="dropdown-item">CANDIDATO</RouterLink>
                  <RouterLink to="/cadastrore" class="dropdown-item">RECRUTADOR</RouterLink>
              </div>
          </div>
      </header>
      <!-- Ícones decorativos ao redor -->
      <div class="icons">
          <img src="@/assets/icons/pencil.png" alt="Pencil Icon" class="icon icon-pencil" />
          <img src="@/assets/icons/computer.png" alt="Computer Icon" class="icon icon-computer" />
          <img src="@/assets/icons/bubble.svg" alt="Bubble Icon" class="icon icon-bubble" />
          <img src="@/assets/icons/lightbubble.svg" alt="lightbubble Icon" class="icon icon-lightbubble" />
          <img src="@/assets/icons/star.svg" alt="Star Icon" class="icon icon-star" />
          <img src="@/assets/icons/bulb.png" alt="Lightbulb Icon" class="icon icon-bulb" />
      </div>
      <main class="content">
          <h1 class="title">Crie uma jornada de R&S</h1>
          <h2 class="subtitle">mais moderna e otimizada.</h2>
          <p class="description">
              Melhore a sua aquisição e qualificação de talentos <br>com o sistema de recrutamento Recrutiva.
          </p>
          <RouterLink to="/loginre" class="cta-button">CONHEÇA AGORA!</RouterLink>
      </main>
  </div>
</template>

<script>
export default {
  name: "HomePage",
  data() {
      return {
          isDropdownVisible: false,
      };
  },
  methods: {
      toggleDropdown() {
          this.isDropdownVisible = !this.isDropdownVisible;
      },
      handleOutsideClick(event) {
          const dropdown = this.$el.querySelector(".dropdown");
          if (!dropdown.contains(event.target)) {
              this.isDropdownVisible = false;
          }
      },
  },
  mounted() {
      // Fecha o dropdown se o usuário clicar fora dele
      document.addEventListener("click", this.handleOutsideClick);
  },
  beforeDestroy() {
      document.removeEventListener("click", this.handleOutsideClick);
  },
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');

@import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap');


.homepage {
  font-family: 'Poppins', sans-serif;
  text-align: center;
  color: #333;
}

.header {
  display: flex;
  justify-content: space-between;
  padding: 1.25rem;
}

.logo-text {
  font-family: 'Roboto mono', sans-serif;
  font-weight: 700;
  font-size: 3.5rem;
  text-align: left;
  color: #f02424;
  letter-spacing: 0.1em;
  margin: 0;
  padding-top: 3%;
}

.logo {
  width: 7.875rem;
}

.login-button {
  font-size: 1.2rem;
  font-weight: bold;
  text-transform: uppercase;
  color: #333;
  background: none;
  border: none;
  cursor: pointer;
  padding: 2rem;
}

.login-button:hover {
  color: #f02424;
}

.content {
  padding: 3.125rem 1.25rem;
}

.title {
  font-size: 4.5rem;
  color: white;
  background-color: #f02424;
  padding: .625rem 1.25rem;
  display: inline-block;
  border-radius: 8px;
}

.subtitle {
  font-size: 4rem;
  color: #333;
  margin-top: .625rem;
}

.description {
  font-size: 1.7rem;
  color: #666;
  margin-top: .625rem;
  text-align: center;
  padding: 2rem;
}

.cta-button {
  background-color: #f02424;
  color: white;
  border: none;
  border-radius: 100px;
  padding: .9375rem 3.875rem;
  font-size: 1.5rem;
  cursor: pointer;
  margin-top: 1.25rem;
  text-decoration: none;
}

.cta-button:hover {
  background-color: #333;
}

.icons {
  display: flex;
  justify-content: center;
  gap: 1.25rem;
  margin-top: 1.875rem;
}

@keyframes rotate-icon {
  0% {
      transform: rotate(0deg);
  }

  50% {
      transform: rotate(25deg);
      /* Gira 25º no sentido horário */
  }

  100% {
      transform: rotate(0deg);
      /* Volta à posição inicial */
  }
}

.icon {
  width: 4.5rem;
  height: 4.5rem;
  position: absolute;
  animation: rotate-icon 10s ease-in-out infinite;
  /* Animação contínua com um ciclo completo de ida e volta */
}

.icon-pencil {
  width: 5.5rem;
  height: 5.5rem;
  top: 30%;
  left: 5%;
}

.icon-computer {
  width: 5.5rem;
  height: 5.5rem;
  top: 52%;
  left: 14%;
}

.icon-bubble {
  bottom: 14%;
  left: 7%;
}

.icon-star {
  top: 30%;
  right: 5%;
}

.icon-bulb {
  width: 5.5rem;
  height: 5.5rem;
  top: 50%;
  right: 12%;
}

.icon-lightbubble {
  width: 5.5rem;
  height: 5.5rem;
  bottom: 12%;
  right: 8%;
}

.icon-lightbubble .dropdown {
  position: relative;
  display: inline-block;
}

.arrow {
  font-size: .825rem;
}

.dropdown-menu {
  display: block;
  position: absolute;
  top: 50%;
  right: 0;
  background-color: #f02424;
  box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
  min-width: 10rem;
  z-index: 1;
  border-radius: 4px;
}

.dropdown-item {
  color: #333;
  padding: .75rem 1rem;
  text-decoration: none;
  display: block;
}

.dropdown-item:hover {
  background-color: #f1f1f1;
}
</style>