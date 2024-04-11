import HomeView from '../views/home/homeview.vue'
import RegisterView from '../views/register/registerview.vue'
import LoginView from '../views/login/loginview.vue'
import CartView from '../views/cart/cartview.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
      {
        path: '/',
        name: 'home',
        component: HomeView
      },
      {
        path: '/register',
        name: 'register',
        component: RegisterView
      },
      {
        path: '/login',
        name: 'login',
        component: LoginView
      },
      {
        path: '/cart',
        name: 'cart',
        component: CartView
      }
    ]
})

export default router