<template>
    <div class="container">
        <h2>新規登録</h2>
        <form class="login-form">
            <div class="input-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" v-model="email" />
                //v-modelで結びつける
            </div>
            <div class="input-group">
                <label for="password">パスワード</label>
                <input
                    type="password"
                    id="password"
                    v-model="password"
                />//v-modelで結びつける
            </div>
            <div class="input-group">
                <button type="button" @click="register()">新規登録</button
                >//クリックしたらregister()発火
            </div>
        </form>
    </div>
</template>

<script>
import axios from "../../axios-for-auth"; //axiosのインスタンスをインポート
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
