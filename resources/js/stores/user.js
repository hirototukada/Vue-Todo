// stores/counter.js
import axios from "axios";
import { defineStore } from "pinia";

export const useUserStore = defineStore("users", {
    state: () => ({
        name: "",
        email: "",
        authCheck: false,
    }),
    actions: {
        // ログアウトしたとき初期化
        init() {
            this.name = "";
            this.email = "";
            this.authCheck = false;
        },
        async getUserData(email) {
            console.log(email);
            await axios
                .get("/api/getUserData/" + email)
                .then((res) => {
                    this.name = res.data.name;
                    this.email = res.data.email;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
});
