<template>
    <div class="containerCss container text-center">
        <form class="w-75 m-auto border bg-light p-5">
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
                    class="btn btn-success w-50 p-2 rounded-pill"
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
        login() {
            //　axiosでログイン用のインスタンスにアクセスするメソッドを定義
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
                    console.log(response); //返ってきたレスポンスをログに表示
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

<style>
h2 {
    color: rgb(153, 199, 153);
}
.input-group {
    margin: 5px;
}

.containerCss {
    margin-top: 100px;
}
</style>
