import { createRouter, createWebHistory } from 'vue-router';

import AboutPage from '@/pages/AboutPage.vue';
// import ClipPage from '@/pages/ClipPage.vue';
import EditClipPage from '@/pages/EditClipPage.vue';
import HomePage from '@/pages/HomePage.vue';
import LoginPage from '@/pages/LoginPage.vue';
import RegisterPage from '@/pages/RegisterPage.vue';
// import StoryCreatePage from '@/pages/StoryCreatePage.vue';
// import StoryPage from '@/pages/StoryPage.vue';
// import UserPage from '@/pages/UserPage.vue';
import VideoSearchPage from '@/pages/VideoSearchPage.vue';

const routes = [
    { path: '/', component: HomePage },
    { path: '/register', component: RegisterPage },
    { path: '/login', component: LoginPage },
    { path: '/about', component: AboutPage },
    { path: '/video/search', component: VideoSearchPage },
    { path: '/edit/clip/:hash', component: EditClipPage },
    //{ path: '/clip/:hash', component: ClipPage },
    //{ path: '/story-create', component: StoryCreatePage },
    //{ path: '/story/:hash', component: StoryPage },
    //{ path: '/user/:hash', component: UserPage },
    { path: '/:pathMatch(.*)*', redirect: '/' },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;