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
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router
