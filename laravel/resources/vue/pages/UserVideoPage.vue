<template>
    <div>
        <Header />
        <div class="page-container w-100 h-100 text-wrap">
            <h2 class="my-2 fs-5">クリップしたビデオ一覧</h2>
            <div>
                <div
                    v-for="video in videos"
                    :key="video.id"
                    class="p border border-dark"
                    @click="goToPage(`/user/video/${video.id}`)"
                >
                    <img :src="video.thumbnail" class="fs-4" />
                    <div class="fs-6">{{ video.title }}</div>
                </div>
            </div>
            <div>
                <button
                    class="btn btn-outline-dark w-50 my-4"
                    @click="goToPage('/')"
                >
                    戻る
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Header from "@/components/HeaderMini.vue";
export default {
    components: {
        Header,
    },
    data() {
        return {
            videos: [],
        };
    },
    mounted() {
        setTimeout(() => {
            this.get();
        }, 1000);
    },
    methods: {
        async get() {
            const response = await axios.get("/api/user/video");
            this.videos = response.data;
        },
        goToPage(path) {
            this.$router.push(path);
        },
    },
};
</script>

<style scoped>
.page-container {
    background-color: #222;
    border: 1px solid #444;
    padding: 3em 1em;
    text-align: center;
}
.p {
    margin: 10px auto;
    padding: 20px;
}
</style>
