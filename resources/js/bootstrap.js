import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

import store from "./store/index.js";

axios.interceptors.response.use(function (response) {
    return response;
}, async function (error) {
    if (error.response && error.response.status === 401) {
        await store.dispatch('auth/logout')
        window.location.href = "/login";
    }
    return Promise.reject(error);
});
