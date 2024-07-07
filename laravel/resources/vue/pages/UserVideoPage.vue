<template>
    <div class="page-container w-100 h-100 text-wrap">
        <h2 class="my-2 fs-2">クリップしたビデオ一覧</h2>
        <div>
            <div
                v-for="video in videos"
                :key="video.id"
                class="p border border-dark"
            >
                <div class="fs-4">{{ video.title }}</div>
                <div class="fs-6">{{ video.url }}</div>
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
</template>

<script>
import axios from "axios";
export default {
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
            //console.log(response.data);
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
    text-align: center;
}
.p {
    margin: 10px auto;
    padding: 20px;
}
</style>
