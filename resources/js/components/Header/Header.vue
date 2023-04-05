<template>
    <!-- ナビゲーションバー -->
    <nav class="navbar navbar-light bg-light">
        <!-- タイトル -->
        <router-link to="/">Navbar</router-link>
        <!-- ハンバーガーメニュー -->
        <button
            class="navbar-toggler"
            type="button"
            @click="navSwitch"
            aria-controls="navbarNav"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- ナビゲーションメニュー -->
        <div class="navbar-collapse" v-show="show" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item mt-1">mypage</li>
                <li class="nav-item mt-1">
                    <router-link
                        class="mr-3 list"
                        v-if="userStore.authCheck == true"
                        to="/"
                        >ホーム</router-link
                    >
                </li>
                <li class="nav-item mt-1">
                    <router-link
                        class="list"
                        v-if="userStore.authCheck == false"
                        to="/login"
                        >ログイン</router-link
                    >
                </li>
                <li class="nav-item">
                    <a
                        class="logout list"
                        v-if="userStore.authCheck == true"
                        @click="logOut"
                        >ログアウト</a
                    >
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
import { onAuthStateChanged, signOut } from "@firebase/auth";
import { onMounted, ref } from "vue";
import auth from "../../api/firebase";
import { useRouter } from "vue-router";
import { useUserStore } from "../../stores/user";

export default {
    setup() {
        const router = useRouter();
        const userStore = useUserStore();
        let show = ref(false);
        onMounted(() => {
            onAuthStateChanged(auth, (user) => {
                if (user) {
                    // ログイン中
                    userStore.authCheck = true;
                } else {
                    // ログアウト中
                    userStore.authCheck = false;
                }
            });
        });
        // ログアウト処理
        const logOut = () => {
            signOut(auth);
            userStore.init();
            router.push({ name: "Login" });
        };

        // ナビゲーション切り替え
        const navSwitch = () => {
            if (show.value == true) {
                show.value = false;
            } else {
                show.value = true;
            }
        };

        return {
            onAuthStateChanged,
            logOut,
            userStore,
            show,
            navSwitch,
        };
    },
};
</script>

<style>
.logout {
    cursor: pointer;
}
.list {
    text-decoration: none;
    color: rgb(153, 199, 153);
}
</style>
