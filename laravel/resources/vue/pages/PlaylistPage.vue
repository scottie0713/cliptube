<template>
    <div>
        <Header />
        <PlaylistTitle />

        <div class="page-container">
            <!-- 検索結果一覧 -->
            <div class="row">
                <div
                    v-for="video in videos"
                    class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3"
                >
                    <VideoListMyVideos :video="video" />
                </div>
            </div>
            <!-- /検索結果一覧 -->
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { apiGet, apiPost } from "~js/utils/api.js";
import Header from "@/components/Header.vue";
import PlaylistTitle from "@/components/Playlist/Title.vue";
import PlaylistLists from "@/components/Playlist/Lists.vue";

export default {
    components: {
        Header,
        PlaylistTitle,
        // VideoListMyVideos,
    },
    data() {
        return {
            query: "",
            videos: [],
        };
    },
    created() {
        apiGet("/api/playlist/list/my", this.setVideos, () => {});
    },
    methods: {
        setVideos(videos) {
            for (const v of videos) {
                this.videos.push({
                    id: v.id,
                    title: v.title,
                    thumbnail: v.thumbnail,
                });
            }
        },
    },
};
</script>

<style scoped>
.page-container {
    width: 90%;
    margin: 0 auto;
}

.video-box-thumbnail {
    width: 120px;
}
</style>
