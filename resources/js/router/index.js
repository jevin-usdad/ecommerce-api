import { createRouter, createWebHistory } from 'vue-router';
import Login from '../views/Login.vue';
import List from '../views/List.vue';
import AddSeller from '../views/AddSeller.vue';

const routes = [
  { path: '/', component: Login },
  {
    path: '/list',
    component: List,
    meta: { requiresAuth: true },
  },
  { path: '/stepperform', component: AddSeller,  meta: { requiresAuth: true } }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const token = sessionStorage.getItem('auth_token');

  if (to.meta.requiresAuth && !token) {
    next('/');
  } else {
    next();
  }
});

export default router;
