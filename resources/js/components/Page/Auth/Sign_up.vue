<template>
    <div class="containerCss container text-center">
        <p class="text-danger">{{ errorMessage }}</p>
        <form class="w-75 m-auto border bg-light p-5">
            <h2 class="mb-4">新規登録</h2>
            <div class="mb-4 text-center">
                <input
                    type="name"
                    class="p-2 w-100"
                    id="name"
                    v-model="name"
                    @blur="handleName"
                    placeholder="ユーザー名"
                />
            </div>
            <p class="text-danger">{{ errors.name }}</p>
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
                    @click="register"
                    class="btn btn-success w-50 p-2 rounded-pill"
                >
                    登録
                </button>
            </div>
        </form>
    </div>
</template>
<script>
import { createUserWithEmailAndPassword } from "@firebase/auth";
import auth from "../../../api/firebase";
import { useRouter } from "vue-router";
import { ref } from "vue";
// バリデーション関連
import { useField, useForm } from "vee-validate";
import { object, string } from "yup";
import { userEntry } from "./common/user";

export default {
    setup() {
        const router = useRouter();
        let errorMessage = ref();
        // バリデーション一括設定
        const schema = object({
            name: string().required("※名前は必須項目です。"),
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
        const { value: name, handleChange: handleName } = useField("name");
        const { value: email, handleChange: handleEmail } = useField("email");
        const { value: password, handleChange: handlePassword } =
            useField("password");

        // ログイン
        const register = handleSubmit((userParam) => {
            createUserWithEmailAndPassword(
                auth,
                userParam["email"],
                userParam["password"]
            )
                .then((userCredential) => {
                    userEntry(userParam);
                    // router.push({ name: "Login" });
                })
                .catch((error) => {
                    const errorCode = error.code;
                    if (errorCode == "auth / invalid - email") {
                        errorMessage.value = "無効なメールアドレスです。";
                    } else if (errorCode == "auth/email-already-in-use") {
                        errorMessage.value =
                            "このメール アドレスは、別のアカウントで既に使用されています。";
                    } else {
                        errorMessage.value =
                            "サーバーエラーです。後でもう一度ログインしてみてください。";
                    }
                });
        });
        return {
            register,
            name,
            email,
            password,
            handleName,
            handleEmail,
            handlePassword,
            errors,
            meta,
            errorMessage,
        };
    },
};
</script>
