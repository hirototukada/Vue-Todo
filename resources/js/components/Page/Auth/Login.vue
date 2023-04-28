<template>
    <div class="containerCss container text-center">
        <transition name="fade">
            <Modal v-if="errorStore.show"></Modal>
        </transition>
        <form class="w-75 m-auto border bg-light p-5">
            <h2 class="mb-4">ログイン</h2>
            <div class="mb-4 text-center h-100">
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
import { ref } from "vue";
import { useRouter } from "vue-router";
// バリデーション関連
import { useField, useForm } from "vee-validate";
import { object, string } from "yup";
import Modal from "../../Modal/Modal.vue";
import { useErrorStore } from "../../../stores/error";
import { useUserStore } from "../../../stores/user";

export default {
    components: {
        Modal,
    },
    setup() {
        const router = useRouter();
        const errorStore = useErrorStore();
        const userStore = useUserStore();

        // バリデーション一括設定
        const schema = object({
            email: string()
                .required("※メールアドレスは必須項目です。")
                .email("正しいメールアドレスで記入してください"),
            password: string()
                .required("※パスワードは必須項目です。")
                .min(6, "※６文字以上で記載してください。"),
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
                    userStore.getUserData(userCredential.user.email);
                    let userEmail = userCredential.user.email;
                    router.push({
                        name: "Home",
                        query: { email: userEmail },
                    });
                })
                .catch((error) => {
                    const errorCode = error.code;
                    if (errorCode == "auth/wrong-password") {
                        errorStore.massage = "無効なパスワードです。";
                    } else if (errorCode == "auth/too-many-requests") {
                        errorStore.massage =
                            "ログインに何度も失敗したため、このアカウントへのアクセスは一時的に無効になっています。パスワードをリセットしてすぐに復元するか、後でもう一度やり直してください。";
                    } else {
                        errorStore.massage =
                            "サーバーエラーです。後でもう一度ログインしてみてください。";
                    }
                    errorStore.switch();
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
            errorStore,
            userStore,
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
