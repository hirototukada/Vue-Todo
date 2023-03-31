import "./bootstrap";
import { createApp } from "vue";
import "bootstrap/dist/css/bootstrap.min.css";
import router from "./router";
import App from "./App.vue";
import store from "./store";
import auth from "./api/firebase";

const app = createApp(App).use(router, store, auth);
app.mount("#app");
