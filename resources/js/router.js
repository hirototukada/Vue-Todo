import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/Page/Home.vue";
import About from "./components/Page/Login.vue";
import Todo_add from "./components/Page/Todo/Todo_add.vue";
import Todo_edit from "./components/Page/Todo/Todo_edit.vue";

const routes = [
    { path: "/", redirect: "/home" },
    {
        path: "/home",
        name: "Home",
        component: Home,
        children: [
            {
                path: "home",
                component: "テスト",
            },
        ],
    },
    { path: "/todoAdd", name: "Todo_add", component: Todo_add },
    { path: "/todoEdit/:id", name: "Todo_edit", component: Todo_edit },
    { path: "/login", name: "Login", component: About },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
