<script setup>
import {useStore} from "vuex";
import {computed, onMounted, ref} from "vue";
import {useRouter} from "vue-router";
import BoxArrowRight from "../Components/Icons/BoxArrowRight.vue";
const props = defineProps({
    authenticated:Boolean
})
const menu = [
    {
        category: 'Settings',
        icon:'bi bi-gear',
        links: [
            { url: '/settings/registration', name: 'Registration settings'},
            { url: '/settings/emails', name: 'Email settings'}
        ]
    }
];

const store = useStore();

const authenticated = computed(() => {
    return store.getters['auth/authenticated']
})

const user = computed(() => {
    return store.getters['auth/user']
})

const router = useRouter();

const logout = async () => {
    try {
        await store.dispatch('auth/logout');
        await router.push('/login');
    } catch (error) {
        console.error(error);
    }
};

const openMenuButton = ref(null);

const closeOffcanvas = () => {
    openMenuButton.value?.click();
};

onMounted(async () => {
    if(props.authenticated){
        await store.dispatch('auth/userInfo');
    }
});

</script>

<template>
    <nav class="navbar navbar-dark bg-dark text-white">
        <div class="container-fluid">
            <button ref="openMenuButton" v-if="authenticated" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"
                    aria-controls="offcanvasMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon fs-6 text-white"></span>
            </button>

            <div class="d-flex ms-auto gap-2">
                <router-link v-if="!authenticated" class="nav-link text-white" :to="{name:'login'}">Login</router-link>
                <a v-if="authenticated" @click="logout" href="#" class="nav-link text-white">{{user.name}} <BoxArrowRight/> Logout</a>
            </div>
        </div>
    </nav>

    <div v-if="authenticated" class="offcanvas offcanvas-start  text-bg-dark" tabindex="-1" id="offcanvasMenu"
         aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="mb-3" v-for="menuItem  in menu">

                <button class="nav-link" type="button" data-bs-toggle="collapse" :data-bs-target="'#'+menuItem.category" aria-expanded="false" :aria-controls="menuItem.category">
                    <span v-if="menuItem.icon" :class="menuItem.icon"></span> {{ menuItem.category }}
                </button>
                <div class="collapse" :id="menuItem.category">

                    <div class="nav flex-column ms-1">
                        <div v-for="link in menuItem.links">
                            <router-link @click="closeOffcanvas" activeClass="fw-bold bg-secondary" class="nav-link text-white" :to="link.url">{{ link.name }}</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
