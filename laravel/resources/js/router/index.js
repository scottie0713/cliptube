import { createRouter, createWebHistory } from "vue-router";

import ClipPage from "@/pages/ClipPage.vue";
import ClipEditPage from "@/pages/ClipEditPage.vue";
import HomePage from "@/pages/HomePage.vue";
// import UserClipPage from "@/pages/UserClipPage.vue";
// import UserVideoPage from "@/pages/UserVideoPage.vue";
import PlaylistPage from "@/pages/PlaylistPage.vue";
import VideoListPage from "@/pages/VideoListPage.vue";
import YouTubeSearchPage from "@/pages/YouTubeSearchPage.vue";

const routes = [
    { path: "/", component: HomePage },
    { path: "/clip/:hash/edit", component: ClipEditPage },
    { path: "/clip/:hash", component: ClipPage },
    // { path: "/user/video/:hash", component: UserClipPage },
    // { path: "/user/video", component: UserVideoPage },
    { path: "/playlist/:hash", component: PlaylistPage },
    { path: "/video/list/:hash", component: VideoListPage },
    { path: "/youtube/search", component: YouTubeSearchPage },
    { path: "/:pathMatch(.*)*", redirect: "/" },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
