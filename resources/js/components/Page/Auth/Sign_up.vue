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
import { createUserWithEmailAndPassword } from "@firebase/auth";
import auth from "../../../api/firebase";

export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        register() {
            createUserWithEmailAndPassword(auth, this.email, this.password)
                .then((userCredential) => {
                    const user = userCredential.user;
                    console.log("OK");
                    console.log(user);
                })
                .catch((error) => {
                    const errorCode = error.code;
                    const errorMessage = error.message;
                    console.log("NG");
                });

            this.email = "";
            this.password = "";
        },
    },
};
</script>
