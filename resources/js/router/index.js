import {createRouter, createWebHistory} from "vue-router";
import store from "../store/index.js";

import Login from "@/Pages/Auth/Login.vue";

import MainLayout from "@/Layouts/MainLayout.vue";

const routes = [
    {
        path: '/',
        component: MainLayout,
        children: [

            {
                name: "login",
                path: "login",
                component: Login,
                meta: {
                    middleware: "guest",
                    title: `Login`
                }
            },

           // Catch-all route for not found pages
            {
                path:"/:notFound(.*)",
                redirect:'/'
            },
        ]
    },

];


const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const middleware = to.meta.middleware;
    const permissions = window.Laravel.jsPermissions;
    const roles = permissions !== 0 ? permissions['roles'] : [];
    const permission = permissions !== 0 ? permissions['permissions'] : 0;
    document.title = to.meta.title ?? 'Gym';
    if (middleware === "guest" || middleware === undefined) {
        next()
    } else {
        let allow;
        if (permission === 0 || roles === []) {
            allow = false;
        } else {
             allow = Array.isArray(roles) && roles.some(role => middleware.includes(role));
        }
        if (allow) {
            next()
        } else {
            await store.dispatch('auth/logout')
            next({name: "login"})
        }
    }
})

export default router;
