require('./bootstrap')
import 'tailwindcss/tailwind.css';

import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router';

import App from './app.vue';
import Login from './components/login'
import Dashboard from './components/dashboard.vue';
import ThankYou from './components/ThankYou.vue';

const routes = [
    { path: '/', component: Login },
    { path: '/dashboard', component: Dashboard }, 
    { path: '/thankyou', component: ThankYou },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

const app = createApp(App);

app.use(router);

app.mount('#app');

// const app = createApp({})

// app.component('login', Login)

// app.mount('#app')