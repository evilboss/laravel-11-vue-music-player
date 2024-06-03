import { createRouter, createWebHistory } from 'vue-router'

import login from '../components/LoginPage.vue'
import register from '../components/RegisterPage.vue'

console.log('router loaded')

const routes = [
  { path: '/login', component: login },
  { path: '/register', component: register },
]

const router = createRouter({
  history: createWebHistory(),
  linkActiveClass: 'active',
  routes
})

export default router
