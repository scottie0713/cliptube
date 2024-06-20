import { createRouter, createWebHistory } from 'vue-router';
import WelcomePage from '@/pages/WelcomePage.vue';
import UserPage from '@/pages/UserPage.vue';

const routes = [
    { path: '/', component: WelcomePage },
    { path: '/user', component: UserPage },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
