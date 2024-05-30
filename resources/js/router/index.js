import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import View from '../views/View.vue'
import Edit from '../views/Edit.vue'
import Add from '../views/Add.vue'




const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/add/',
      name: 'add',
      component: Add,
    },
    {
      path: '/view/:id',
      name: 'view',
      component: View,
    },
    {
      path: '/edit/:id',
      name: 'edit',
      component: Edit,
    }
  ]
})

export default router
