<template>
    <v-app>
        <topHeader></topHeader>
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>
</template>
<script setup>
import topHeader from "./TopHeader.vue"
</script>
