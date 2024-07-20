<template>
    <div>
        <Header />
        <VideoListMyTitle />

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
import VideoListMyTitle from "@/components/VideoListMy/Title.vue";
import VideoListMyVideos from "@/components/VideoListMy/Videos.vue";

export default {
    components: {
        Header,
        VideoListMyTitle,
        VideoListMyVideos,
    },
    data() {
        return {
            query: "",
            videos: [],
        };
    },
    created() {
        apiGet("/api/video/list/my", this.setVideos, () => {});
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
