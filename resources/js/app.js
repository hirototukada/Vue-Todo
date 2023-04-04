import "./bootstrap";
import { createApp } from "vue";
import "bootstrap/dist/css/bootstrap.min.css";
import router from "./router";
import App from "./App.vue";
import auth from "./api/firebase";
import { createPinia } from "pinia";

const app = createApp(App).use(router, auth);
const pinia = createPinia();
app.use(pinia);
app.mount("#app");
