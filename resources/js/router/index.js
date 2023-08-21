import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../BasicScreens/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/signup',
      name: 'signup',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../BasicScreens/SignupView.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../BasicScreens/LoginView.vue')
    },
    {
      path: '/reset-password',
      name: 'reset_password',
      component: () => import('../BasicScreens/ResetPassword.vue')
    },
    {
      path: '/boardify-home',
      name: 'boardify_home',
      component: () => import('../BasicScreens/BoardifyHomeView.vue')
    },
    {
      path: '/user-profile',
      name: 'user_profile',
      component: () => import('../BasicScreens/UserProfileView.vue')
    },
    {
      path: '/verify-email',
      name: 'verify_email',
      component: () => import('../BasicScreens/VerifyEmail.vue')
    },
  ]
})

export default router
