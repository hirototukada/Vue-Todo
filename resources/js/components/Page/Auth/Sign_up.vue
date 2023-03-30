<template>
    <div class="containerCss container text-center">
        <form class="w-75 m-auto border bg-light p-5">
            <h2 class="mb-4">新規登録</h2>
            <div class="mb-4 text-center">
                <input
                    type="email"
                    class="p-2 w-100"
                    id="email"
                    v-model="email"
                    placeholder="メールアドレス"
                />
            </div>
            <div class="mb-3 text-center">
                <input
                    type="password"
                    class="p-2 w-100"
                    id="password"
                    v-model="password"
                    placeholder="パスワード"
                />
            </div>
            <div class="mb-3 text-center">
                <button
                    type="button"
                    @click="register()"
                    class="btn btn-success w-50 p-2 rounded-pill"
                >
                    新規登録
                </button>
            </div>
        </form>
    </div>
</template>
<script>
//axiosのインスタンスをインポート
import axios from "../../../router/api/firebase_route";
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        register() {
            //axiosでapiを叩くメソッドを定義
            axios
                .post(
                    "/accounts:signUp?key=AIzaSyDCBKVwJyEsM_86KwFwaMuVyF89FIQKQ1w",
                    {
                        email: this.email,
                        password: this.password,
                        returnSecureToken: true,
                    }
                )
                .then((response) => {
                    //返ってきたレスポンスをログに表示
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });
            this.email = "";
            this.password = "";
        },
    },
};
</script>
