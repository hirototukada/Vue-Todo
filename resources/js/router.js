import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/Page/Home.vue";
import Login from "./components/Page/Auth/Login.vue";
import Todo_add from "./components/Page/Todo/Todo_add.vue";
import Todo_edit from "./components/Page/Todo/Todo_edit.vue";
import Sign_up from "./components/Page/Auth/Sign_up.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
        // メタフィールド
        meta: { requiresAuth: true },
    },
    {
        path: "/todoAdd",
        name: "Todo_add",
        component: Todo_add, // メタフィールド
        meta: { requiresAuth: true },
    },
    {
        path: "/todoEdit",
        name: "Todo_edit",
        component: Todo_edit,
        props: true,
        // メタフィールド
        meta: { requiresAuth: true },
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/signUp",
        name: "Sign_up",
        component: Sign_up,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
