<template>
    <div class="container">
        <h2>新規登録</h2>
        <form class="login-form">
            <div class="input-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" v-model="email" />
            </div>
            <div class="input-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" v-model="password" />
            </div>
            <div class="input-group">
                <button type="button" @click="register()">新規登録</button>
            </div>
        </form>
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
                    console.log(response); //返ってきたレスポンスをログに表示
                });
            this.email = "";
            this.password = "";
        },
    },
};
</script>
