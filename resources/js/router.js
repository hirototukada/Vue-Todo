import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/Page/Home.vue";
import About from "./components/Page/Login.vue";

const routes = [
    { path: "/", redirect: "/home" },
    {
        path: "/home",
        name: "Home",
        component: Home,
        children: [
            {
                path: "Todo",
                component: "profile",
            },
        ],
    },
    { path: "/login", name: "Login", component: About },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
