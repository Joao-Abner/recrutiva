<template>
  <!-- <header>
    <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />

    <div class="wrapper">
      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/cadastro">Cadastro</RouterLink>
      </nav>
    </div>
  </header> -->

  <main>
    <RouterView />
  </main>
</template>

<script>
import HomeView from './views/HomeView.vue';

export default {
  name: 'App',
  components: {
    HomeView,
  },
};
</script>

<style>
#app {
  font-family: Arial, sans-serif;
  text-align: center;
  color: #333;
  margin-top: 0;
}
</style>
