<template>
    <nav class="navbar navbar-light bg-light">
        <div class="w-100 d-flex justify-content-between">
            <div class="container-fluid">
                <router-link class="mr-3" to="/home">
                    <span class="navbar-brand mb-0 h1">Navbar</span>
                </router-link>
            </div>
            <div class="container-fluid">
                <a class="navbar-brand text-right w-100">
                    <router-link class="mr-3" to="/">ホーム</router-link>
                    <router-link to="/login">ログイン</router-link>
                </a>
            </div>
        </div>
    </nav>
</template>

<script>
import { onAuthStateChanged } from "@firebase/auth";
import { onMounted } from "vue";
import auth from "../../api/firebase";

export default {
    setup() {
        onMounted(() => {
            onAuthStateChanged(auth, (user) => {
                if (user) {
                    console.log("ログイン中");
                } else {
                    console.log("ログアウト中");
                }
            });
        });

        return {
            onAuthStateChanged,
        };
    },
};
</script>
