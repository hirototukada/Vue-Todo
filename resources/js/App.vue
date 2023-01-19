<script setup>
import Hello from './components/Hello.vue';
import Header from './components/Header/Header.vue';
import Home from './components/main/Home.vue';
import About from './components/main/About.vue';
</script>

<template>
<Header />
<h1>Vue 3 入門</h1>
<Hello />
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
