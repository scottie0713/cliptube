<template>
    <div>
        <Header :user="user" />
        <YouTubeSearchTitle />
        <div class="page-container">
            <!-- 動画検索フォーム -->
            <form
                @submit.prevent="searchVideo"
                class="page-form d-flex justify-content-center gap-3 mb-4"
            >
                <input
                    type="text"
                    v-model="query"
                    placeholder="検索ワードを入力してください"
                    class="form-control"
                />
                <button type="submit" class="btn btn-outline-light">
                    検索
                </button>
            </form>
            <!-- /動画検索フォーム -->

            <!-- 検索結果一覧 -->
            <div
                v-if="videos.length > 0"
                class="row video-container d-flex justify-content-start flex-wrap"
            >
                <div
                    v-for="v in videos"
                    class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3"
                >
                    <div
                        class="video-box d-flex justify-content-center align-items-center gap-2 word-break"
                        @click="clickVideo(v)"
                    >
                        <div class="video-box-thumbnail">
                            <img
                                :src="v.thumbnail"
                                class="card-img-top"
                                :alt="v.title"
                                width="180"
                            />
                        </div>
                        <div class="flex-fill">
                            <div style="font-size: 0.8rem">
                                {{ v.title }}
                            </div>
                            <div style="font-size: 0.6rem">
                                {{ v.channelTitle }}
                            </div>
                            <div style="font-size: 0.6rem">
                                {{ formatDate(v.publishedAt) }}投稿
                            </div>
                        </div>
                    </div>
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
import YouTubeSearchTitle from "@/components/YouTubeSearch/Title.vue";

export default {
    components: {
        Header,
        YouTubeSearchTitle,
    },
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            query: "",
            videos: [],
        };
    },
    mounted() {
        console.log(this.user);
    },
    methods: {
        async searchVideo() {
            apiGet(
                "/api/youtube/search?query=" + this.query,
                this.searchVideoCallback,
                () => {}
            );
        },
        searchVideoCallback(response) {
            this.videos = response.items;
        },
        async postVideo(id, title, thumbnail) {
            try {
                const response = await axios.post("/api/video", {
                    id: id,
                    title: title,
                    thumbnail: thumbnail,
                });
                if (response.status === 201) {
                    return true;
                }
            } catch (error) {
                console.error(error);
                return false;
            }
        },
        clickVideo(video) {
            if (this.postVideo(video.id, video.title, video.thumbnail)) {
                this.goToPage(`/clip/${video.id}/edit`);
            }
        },
        formatDate(dateString) {
            const date = new Date(dateString);
            return (
                date.getFullYear() +
                "/" +
                (date.getMonth() + 1) +
                "/" +
                date.getDate()
            );
        },
        goToPage(path) {
            this.$router.push(path);
        },
    },
};
</script>

<style scoped>
.page-container {
    padding: 2rem;
    margin: 0 auto;
}

.page-form {
    margin: 0 auto;
}

.page-form button {
    width: 5em;
}

.video-container {
    width: 100%;
}

.video-box {
    margin: 0.4rem;
    background-color: #e0e0d1;
    border: 2px solid #e0e0d1;
    border-radius: 0.8rem;
    padding: 0.8rem 1.2rem;
    color: #333;
    cursor: pointer;
}

.video-box-thumbnail {
    width: 120px;
}
</style>
