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
                    <router-link v-if="authUser == false" to="/login"
                        >ログイン</router-link
                    >
                    <a class="logout" v-if="authUser == true" @click="logOut"
                        >ログアウト</a
                    >
                </a>
            </div>
        </div>
    </nav>
</template>

<script>
import { onAuthStateChanged, signOut } from "@firebase/auth";
import { onMounted, ref } from "vue";
import auth from "../../api/firebase";
import { useRouter } from "vue-router";

export default {
    setup() {
        const router = useRouter();
        let authUser = ref(false);
        onMounted(() => {
            onAuthStateChanged(auth, (user) => {
                if (user) {
                    authUser.value = true;
                    console.log("ログイン中");
                } else {
                    authUser.value = false;
                    console.log("ログアウト中");
                }
            });
        });

        const logOut = () => {
            signOut(auth);
            router.push({ name: "Login" });
        };

        return {
            onAuthStateChanged,
            logOut,
            authUser,
        };
    },
};
</script>

<style>
.logout {
    cursor: pointer;
}
</style>
