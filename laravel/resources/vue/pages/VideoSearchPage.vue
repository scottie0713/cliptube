<template>
    <div>
        <Header />

        <!-- 動画検索フォーム -->
        <div class="page-form-container">
            <h2 class="my-2 fs-5 mb-4">まずはクリップの動画を探します</h2>

            <form
                @submit.prevent="searchMovie"
                class="d-flex justify-content-center gap-3"
            >
                <input
                    type="text"
                    v-model="query"
                    placeholder="検索ワードを入力してください"
                    class="form-control w-75"
                />
                <button type="submit" class="btn btn-outline-light">
                    検索
                </button>
            </form>
        </div>
        <!-- /動画検索フォーム -->

        <!-- 検索結果一覧 -->
        <div
            v-if="videos.length > 0"
            class="page-viceos-container d-flex gap-3 my-4 justify-content-center flex-wrap"
        >
            <div v-for="v in videos" class="card" style="width: 10rem">
                <div @click="goToPage('/edit/clip/' + v.id)">
                    <img
                        :src="v.thumbnail"
                        class="card-img-top"
                        :alt="v.title"
                    />
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 0.8rem">
                            {{ v.title }}
                        </h5>
                        <p class="card-text" style="font-size: 0.6rem">
                            {{ formatDate(v.publishedAt) }}投稿
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /検索結果一覧 -->
    </div>
</template>

<script>
import axios from "axios";
import Header from "@/components/HeaderMini.vue";
// import VideoSearch from "@/components/VideoSearch.vue";

export default {
    components: {
        Header,
    },
    data() {
        return {
            query: "",
            videos: [],
        };
    },
    mounted() {},
    methods: {
        async searchMovie() {
            try {
                const response = await axios.get("/api/youtube/search", {
                    params: {
                        query: this.query,
                    },
                });
                if (response.status === 200) {
                    this.videos = response.data.items;
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
.page-form-container {
    background-color: #222;
    border: 1px solid #444;
    border-left: transparent;
    border-right: transparent;
    padding: 3em 1em;
    text-align: center;
}

h2 {
    text-align: center;
}

h2 button {
    background: none;
    border: none;
    color: aliceblue;
    font-size: 1em;
    cursor: pointer;
}
</style>
