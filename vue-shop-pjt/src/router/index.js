import { createRouter, createWebHistory } from 'vue-router'
import KakaoLogin from '../views/KakaoLogin'

const routes = [
  {
    path: '/kakaologin',
    name: 'kakaologin',
    component: KakaoLogin
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
