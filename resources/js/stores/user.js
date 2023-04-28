// stores/counter.js
import axios from "axios";
import { defineStore } from "pinia";

export const useUserStore = defineStore("users", {
    state: () => ({
        id: "",
        name: "",
        email: "",
        authCheck: false,
        ee: "hello",
    }),
    actions: {
        // ログアウトしたとき初期化
        init() {
            this.id = "";
            this.name = "";
            this.email = "";
            this.authCheck = false;
        },
        async getUserData(email) {
            await axios
                .get("/api/getUserData/" + email)
                .then((res) => {
                    console.log(res);
                    this.id = res.data.id;
                    this.name = res.data.name;
                    this.email = res.data.email;
                    console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    persist: true,

    // //  SessionStorageに保存
    // persist: {
    //     storage: sessionStorage,
    //     paths: ["someState"],
    // },
});
