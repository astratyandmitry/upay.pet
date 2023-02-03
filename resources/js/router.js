import {createRouter, createWebHashHistory} from "vue-router";

const routes = [
  {
    path: '/',
    redirect: '/payments'
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
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes: routes,
})

export default router;
