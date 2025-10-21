import './bootstrap';

import App from './App.vue';
import { createApp } from 'vue';
import { Ziggy } from './ziggy';
import router from './router/index.js';
import store from './store/index.js';

const app = createApp(App)
    .use(Ziggy)
    .use(router)
    .use(store)
app.mount('#app');
