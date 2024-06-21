import { createRouter, createWebHistory } from 'vue-router';
import WelcomePage from '@/pages/WelcomePage.vue';
import MemberPage from '@/pages/MemberPage.vue';

const routes = [
    { path: '/', component: WelcomePage },
    { path: '/member', component: MemberPage },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
