<template>
    <div>
        <Header />

        <div class="page-container">
            <!-- タイトル -->
            <div
                class="page-title d-flex justify-content-center align-items-center"
            >
                <div>
                    <ImageSearch size="30" />
                </div>
                <div>クリップ検索</div>
            </div>
            <!-- /タイトル -->

            <!-- 動画検索フォーム -->
            <form
                @submit.prevent="searchMovie"
                class="page-form d-flex justify-content-center gap-3 mb-4"
            >
                <input
                    type="text"
                    v-model="query"
                    placeholder="動画タイトルで検索します"
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
                class="d-flex justify-content-center mb-2 gap-2 align-items-center"
            >
                <div>
                    <ImageScissors size="24" />
                </div>
                <div>検索結果</div>
            </div>
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
                        @click="goToPage('/clip/' + v.id)"
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
                            <h5 style="font-size: 0.7rem">
                                {{ v.title }}
                            </h5>
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
import Header from "@/components/Header.vue";
import ImageSearch from "@/components/Images/Search.vue";
import ImageScissors from "@/components/Images/Scissors.vue";

export default {
    components: {
        Header,
        ImageSearch,
        ImageScissors,
    },
    data() {
        return {
            query: "",
            videos: [],
        };
    },
    mounted() {
        this.searchMovie();
    },
    methods: {
        async searchMovie() {
            try {
                const response = await axios.get("/api/video/list", {
                    params: {
                        query: this.query,
                    },
                });
                if (response.status === 200) {
                    console.log(response.data);
                    this.videos = [];
                    for (const v of response.data) {
                        this.videos.push({
                            id: v.id,
                            title: v.title,
                            thumbnail: v.thumbnail,
                        });
                    }
                }
            } catch (error) {
                console.error(error);
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
    width: 90%;
    margin: 0 auto;
}

.page-title {
    background-color: #c75c5c;
    /* width: 100%; */
    margin: 0 auto 2rem auto;
    padding: 0.2em;
    border-radius: 2em;
}

.page-form {
    /* width: 90%; */
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
    border: 2px solid #fff;
    border-radius: 0.8rem;
    padding: 0.8rem 1.2rem;
    color: #fff;
}

.video-box-thumbnail {
    width: 120px;
}
</style>
