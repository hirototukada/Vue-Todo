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
                    @blur="handleEmail"
                    placeholder="メールアドレス"
                />
            </div>
            <p class="text-danger">{{ errors.email }}</p>
            <div class="mb-3 text-center">
                <input
                    type="password"
                    class="p-2 w-100"
                    id="password"
                    v-model="password"
                    @blur="handlePassword"
                    placeholder="パスワード"
                />
            </div>
            <p class="text-danger">{{ errors.password }}</p>
            <div class="mb-3 text-center">
                <button
                    :disabled="!meta.valid"
                    type="button"
                    @click="login"
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
import { signInWithEmailAndPassword } from "firebase/auth";
import auth from "../../../api/firebase";
import { useRouter } from "vue-router";
// バリデーション関連
import { useField, useForm } from "vee-validate";
import { object, string } from "yup";

export default {
    setup() {
        const router = useRouter();

        // バリデーション一括設定
        const schema = object({
            email: string()
                .required("※メールアドレスは必須項目です。")
                .email("正しいメールアドレスで記入してください"),
            password: string().required("※パスワードは必須項目です。"),
        });

        // スチーマー反映結果格納
        const { errors, meta, handleSubmit } = useForm({
            // バリデーション
            validationSchema: schema,
            // 初期表示
            initialValues: {
                email: "",
                password: "",
            },
        });

        // 各インプット格納
        const { value: email, handleChange: handleEmail } = useField("email");
        const { value: password, handleChange: handlePassword } =
            useField("password");
        // ログイン
        const login = handleSubmit((userParam) => {
            signInWithEmailAndPassword(
                auth,
                userParam["email"],
                userParam["password"]
            )
                .then((userCredential) => {
                    router.push({ name: "Home" });
                })
                .catch((error) => {
                    const errorCode = error.code;
                    const errorMessage = error.message;
                });
        });

        return {
            login,
            email,
            password,
            handleEmail,
            handlePassword,
            errors,
            meta,
        };
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
