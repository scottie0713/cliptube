<template>
    <div>
        <Header />
        <div class="page-container w-100 h-100 text-wrap">
            <h2 class="my-2 fs-5">クリップする動画を探しましょう</h2>
            <hr />
            <VideoSearch />
        </div>
    </div>
</template>

<script>
import Header from "@/components/HeaderMini.vue";
import VideoSearch from "@/components/VideoSearch.vue";

export default {
    components: {
        Header,
        VideoSearch,
    },
    data() {
        return {
            videoId: "",
        };
    },
    mounted() {},
    methods: {
        goToPage(path) {
            this.$router.push(path);
        },
        setMovie(videoId) {
            this.videoId = videoId;
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

h2 {
    text-align: center;
}

hr {
    border: 1px solid #ffffff;
}

h2 button {
    background: none;
    border: none;
    color: aliceblue;
    font-size: 1em;
    cursor: pointer;
}
</style>
