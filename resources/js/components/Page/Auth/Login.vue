<template>
    <div class="container">
        <h2>ログイン</h2>
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
                <button type="button" @click="login()">送信</button>
            </div>
        </form>
    </div>
    <div class="w-50 m-auto">
        <router-link to="/signUp" class="m-auto">新規登録はこちら</router-link>
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
                        email: this.email, //送る情報は新規登録と同じ
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
<style>
.input-group {
    margin: 5px;
}
</style>
