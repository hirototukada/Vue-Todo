// stores/counter.js
import axios from "axios";
import { defineStore } from "pinia";

export const useTodoStore = defineStore("todo", {
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
        async getTodoData() {
            console.log("start");
            await axios
                .get("/api/todo")
                .then((res) => {
                    console.log("入る");
                    return res;
                })
                .catch((err) => {
                    let errorText = "";
                    switch (err.response.status) {
                        case 422:
                            errorText = err.response.data.message;
                            break;

                        default:
                            errorText =
                                "サーバーエラーです。時間をおいてアクセスしてください。";
                            break;
                    }
                    return errorText;
                });
        },
    },
});
