<script setup>
import Header from "./components/Header/Header.vue";
import Modal from "./components/Modal/Modal.vue";
import Footer from "./components/Footer.vue";
</script>

<template>
    <!-- 遷移先設定 -->
    <Header />
    <!-- ページ定義 -->
    <router-view />
    <Footer />
</template>

<script>
export default {
    computed: {
        username() {
            return this.$route.params.username;
        },
    },
    methods: {
        goBack() {
            window.history.length > 1
                ? this.$router.go(-1)
                : this.$router.push("/");
        },
    },
};
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;

    height: 100vh;
}
</style>
