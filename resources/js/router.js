import { createRouter, createWebHistory } from 'vue-router'
import Home from './components/main/Home.vue';
import About from './components/main/About.vue';

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/about', name: 'About', component: About },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
