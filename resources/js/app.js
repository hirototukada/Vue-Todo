import "./bootstrap";
import { createApp } from "vue";
import "bootstrap/dist/css/bootstrap.min.css";
import router from "./router";
import App from "./App.vue";
const app = createApp(App).use(router);
app.mount("#app");
