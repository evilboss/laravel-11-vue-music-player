import { createRouter, createWebHistory } from 'vue-router'

import login from '../components/LoginPage.vue'
import register from '../components/RegisterPage.vue'
import songList from '../components/SongList.vue'

const routes = [
  { path: '/login', component: login },
  { path: '/register', component: register },
  { path: '/songs', component: songList }
]

const router = createRouter({
  history: createWebHistory(),
  linkActiveClass: 'active',
  routes
})

export default router
