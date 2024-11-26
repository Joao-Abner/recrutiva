import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import axios from './config/axiosConfig'; // Importa a configuração do Axios

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

const app = createApp(App);

app.config.globalProperties.$axios = axios; // Adiciona o Axios como uma propriedade global

app.use(router);
app.use(store);

app.mount('#app');