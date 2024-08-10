import { createRouter, createWebHistory } from "vue-router";

import ClipPage from "@/pages/ClipPage.vue";
import ClipEditPage from "@/pages/ClipEditPage.vue";
import HomePage from "@/pages/HomePage.vue";
import PlaylistCreatePage from "@/pages/Playlist/CreatePage.vue";
import PlaylistEditClipPage from "@/pages/Playlist/EditClipPage.vue";
import PlaylistEditTitlePage from "@/pages/Playlist/EditTitlePage.vue";
import UserPlaylistPage from "@/pages/User/PlaylistPage.vue";
import VideoListPage from "@/pages/VideoListPage.vue";
import YouTubeSearchPage from "@/pages/YouTubeSearchPage.vue";

const routes = [
    { path: "/", component: HomePage },
    // Clip
    { path: "/clip/:hash/edit", component: ClipEditPage },
    { path: "/clip/:hash", component: ClipPage },
    // Playlist
    { path: "/playlist/create", component: PlaylistCreatePage },
    { path: "/playlist/:hash/edit-clip", component: PlaylistEditClipPage },
    { path: "/playlist/:hash/edit-title", component: PlaylistEditTitlePage },
    // User
    { path: "/user/:hash/playlist", component: UserPlaylistPage },
    // Etc
    { path: "/video/list/:hash", component: VideoListPage },
    { path: "/youtube/search", component: YouTubeSearchPage },
    // Other path redirect to home
    { path: "/:pathMatch(.*)*", redirect: "/" },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
