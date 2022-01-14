require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import router from './router';
import { createApp } from 'vue';

import DashboardIndex from "./components/DashboardIndex.vue";


createApp({
    components: {
        DashboardIndex
    }
}).use(router).mount('#app');