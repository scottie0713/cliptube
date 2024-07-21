import { createRouter, createWebHistory } from "vue-router";

import ClipPage from "@/pages/ClipPage.vue";
import ClipEditPage from "@/pages/ClipEditPage.vue";
import HomePage from "@/pages/HomePage.vue";
// import UserClipPage from "@/pages/UserClipPage.vue";
// import UserVideoPage from "@/pages/UserVideoPage.vue";
import VideoListPage from "@/pages/VideoListPage.vue";
import VideoListMyPage from "@/pages/VideoListMyPage.vue";
import YouTubeSearchPage from "@/pages/YouTubeSearchPage.vue";

const routes = [
    { path: "/", component: HomePage },
    { path: "/clip/:hash/edit", component: ClipEditPage },
    { path: "/clip/:hash", component: ClipPage },
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
