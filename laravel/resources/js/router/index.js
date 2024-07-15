import { createRouter, createWebHistory } from "vue-router";

import AboutPage from "@/pages/AboutPage.vue";
import ClipPage from "@/pages/ClipPage.vue";
import EditClipPage from "@/pages/EditClipPage.vue";
import HomePage from "@/pages/HomePage.vue";
// import StoryCreatePage from '@/pages/StoryCreatePage.vue';
// import StoryPage from '@/pages/StoryPage.vue';
// import UserClipPage from "@/pages/UserClipPage.vue";
// import UserVideoPage from "@/pages/UserVideoPage.vue";
import VideoListPage from "@/pages/VideoListPage.vue";
import VideoListMyPage from "@/pages/VideoListMyPage.vue";
import YouTubeSearchPage from "@/pages/YouTubeSearchPage.vue";

const routes = [
    { path: "/", component: HomePage },
    { path: "/about", component: AboutPage },
    { path: "/edit/clip/:hash", component: EditClipPage },
    { path: "/clip/:hash", component: ClipPage },
    //{ path: '/story-create', component: StoryCreatePage },
    //{ path: '/story/:hash', component: StoryPage },
    // { path: "/user/video/:hash", component: UserClipPage },
    // { path: "/user/video", component: UserVideoPage },
    { path: "/video/list", component: VideoListPage },
    { path: "/video/list/my", component: VideoListMyPage },
    { path: "/youtube/search", component: YouTubeSearchPage },
    { path: "/:pathMatch(.*)*", redirect: "/" },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
