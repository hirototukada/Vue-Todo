<template>
    <div class="container border mt-4 p-3 text-center border-success form">
        <form class="w-75 m-auto">
            <h2 class="mb-4">ログイン</h2>
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
                    @click="login()"
                    class="btn btn-primary w-50 p-2 rounded-pill"
                >
                    送信
                </button>
            </div>
        </form>
    </div>

    <div class="w-75 m-auto text-center">
        <router-link to="/signUp">新規登録はこちら</router-link>
    </div>
</template>
<script>
import axios from "../../../router/api/firebase_route"; //axiosのインスタンスをインポート
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        login() {
            //axiosでログイン用のインスタンスにアクセスするメソッドを定義
            axios
                .post(
                    //エンドポイントのURLがログイン用のものを使う
                    "/accounts:signInWithPassword?key=AIzaSyDCBKVwJyEsM_86KwFwaMuVyF89FIQKQ1w",
                    {
                        email: this.email,
                        password: this.password,
                        returnSecureToken: true,
                    }
                )
                .then((response) => {
                    //返ってきたレスポンスをログに表示
                    console.log(response);
                });
            this.email = "";
            this.password = "";
        },
    },
};
</script>
<style>
.form {
}
h2 {
    color: green;
}
.input-group {
    margin: 5px;
}
</style>
