<script setup>
import Header from './components/Header/Header.vue';
</script>

<template>
<!-- 遷移先設定 -->
<Header/>
<router-view/>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
