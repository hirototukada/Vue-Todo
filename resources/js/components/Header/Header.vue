<template>
 <nav class="navbar navbar-light bg-light">
    <div class="w-100 d-flex justify-content-between">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Navbar</span>
        </div>
        <div class="container-fluid">
            <a class="navbar-brand text-right w-100">
                <router-link class="mr-3" to="/home">ホーム</router-link>
                <router-link to="/about">About</router-link>
            </a>
        </div>
    </div>
</nav>
</template>
