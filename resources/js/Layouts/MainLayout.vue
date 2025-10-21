<script setup>
import Navbar from "@/Layouts/Navbar.vue";
import {computed} from "vue";
import {useStore} from "vuex";

const store = useStore();
const authenticated = computed(() => {
    return store.getters['auth/authenticated']
})

</script>
<template>
    <div>
        <Navbar :authenticated="authenticated"/>
        <main class="container-fluid mt-4">
            <router-view></router-view>
        </main>
    </div>
</template>
