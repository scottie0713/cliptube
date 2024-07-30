<template>
    <div>
        <Header :user="user" />
        <VideoListTitle />

        <div class="page-container">
            <!-- 検索結果一覧 -->
            <div class="row">
                <div
                    v-for="video in videos"
                    class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3"
                >
                    <VideoListVideos :video="video" />
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
import VideoListTitle from "@/components/VideoList/Title.vue";
import VideoListVideos from "@/components/VideoList/Videos.vue";

export default {
    components: {
        Header,
        VideoListTitle,
        VideoListVideos,
    },
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            userHash: "",
            query: "",
            videos: [],
        };
    },
    created() {
        this.userHash = this.$route.params.hash;
        apiGet(`/api/video/list/${this.userHash}`, this.setVideos, () => {});
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
