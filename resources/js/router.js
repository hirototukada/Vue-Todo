import { createRouter, createWebHistory } from "vue-router";
import Home from './components/Page/Home.vue';
import About from './components/Page/About.vue';

const routes = [
    { path: '/', redirect: '/home' },
  { path: '/home', name: 'Home', component: Home },
  { path: '/about', name: 'About', component: About },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
  });

export default router;
