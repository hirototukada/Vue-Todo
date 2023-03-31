import "./bootstrap";
import { createApp } from "vue";
import "bootstrap/dist/css/bootstrap.min.css";
import router from "./router";
import App from "./App.vue";
import store from "./store";

router.beforeEach((to, from, next) => {
    if (
        to.matched.some((record) => record.meta.requiresAuth) &&
        !Auth.loggedIn
    ) {
        next({ path: "/login", query: { redirect: to.fullPath } });
    } else {
        next();
    }
});

const app = createApp(App).use(router, store);
app.mount("#app");
