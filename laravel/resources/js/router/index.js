import { createRouter, createWebHistory } from 'vue-router';

import AboutPage from '@/pages/AboutPage.vue';
import ClipCreatePage from '@/pages/ClipCreatePage.vue';
import ClipPage from '@/pages/ClipPage.vue';
import HomePage from '@/pages/HomePage.vue';
import StoryCreatePage from '@/pages/StoryCreatePage.vue';
import StoryPage from '@/pages/StoryPage.vue';
import UserPage from '@/pages/UserPage.vue';

const routes = [
    { path: '/', component: HomePage },
    { path: '/about', component: AboutPage },
    { path: '/clip-create', component: ClipCreatePage },
    { path: '/clip/:hash', component: ClipPage },
    { path: '/story-create', component: StoryCreatePage },
    { path: '/story/:hash', component: StoryPage },
    { path: '/user/:hash', component: UserPage },
    { path: '/:pathMatch(.*)*', redirect: '/' },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;