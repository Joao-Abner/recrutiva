import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: {
        title: 'Recrutiva'
      }
    },
    {
      path: '/cadastro',
      name: 'formpage',
      component: () => import('../components/FormPage.vue'),
      meta: {
        title: 'FormPage'
      }
    },
    {
      path: '/cadastrore',
      name: 'formpagere',
      component: () => import('../components/FormPageRe.vue'),
      meta: {
        title: 'FormPageRecrutador'
      }
    },
    {
      path: '/loginre',
      name: 'LoginRe',
      component: () => import('../views/LoginRecrutador.vue'),
      meta: {
        title: 'LoginRecrutador'
      }
    },
    {
      path: '/loginca',
      name: 'Loginca',
      component: () => import('../views/LoginCandidato.vue'),
      meta: {
        title: 'LoginCandidato'
      }
    },
    {
      path: '/dashrecrutador',
      name: 'DashRecrutador',
      component: () => import('../views/DashboardRecrutador.vue'),
      meta: {
        title: 'DashRecrutador'
      }
    },
    {
      path: '/dashcandidato',
      name: 'DashCandidato',
      component: () => import('../views/DashboardCandidato.vue'),
      meta: {
        title: 'DashCandidato'
      }
    },
    {
      path: '/formvagas',
      name: 'formvagas',
      component: () => import('../views/FormularioVagas.vue'),
      meta: {
        title: 'FormVagas'
      }
    },
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router
