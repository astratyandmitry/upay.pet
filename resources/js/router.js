import {createRouter, createWebHashHistory} from "vue-router";
import {useAuthStore} from "./store";
import axios from "axios";

const routes = [
  {
    path: '/',
    redirect: '/payments',
    name: 'home'
  },
  {
    path: '/payments',
    name: 'payments.list',
    component: () => import('./views/PaymentsList.vue'),
  },
  {
    path: '/clients',
    name: 'clients.list',
    component: () => import('./views/ClientsList.vue'),
  },
  {
    path: '/clients/create',
    name: 'clients.create',
    component: () => import('./views/ClientsForm.vue')
  },
  {
    path: '/clients/:id/edit',
    name: 'clients.edit',
    component: () => import('./views/ClientsForm.vue')
  },
  {
    path: '/clients/:id',
    name: 'clients.detail',
    component: () => import('./views/ClientsDetail.vue')
  },
  {
    path: "/login",
    name: "login",
    component: () => import("@/views/LoginPage.vue"),
    meta: {
      requiresAuth: false,
    },
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes: routes,
})

router.beforeEach((to) => {
  if (!Object.prototype.hasOwnProperty.call(to?.meta, "requiresAuth")) {
    to.meta.requiresAuth = true;
  }

  const auth = useAuthStore();

  if (to.meta.requiresAuth && !auth.isLoggedIn) {
    return {
      name: "login",
      query: { redirect: to.fullPath },
    };
  }

  if (to.name === "login" && auth.isLoggedIn) {
    return {
      nane: "home",
    };
  }

  axios.defaults.headers.common = {
    'Authorization': `Bearer ${auth.token}`,
    'Content-type': 'application/json',
    'Accept': 'application/json',
  }
});

export default router;
