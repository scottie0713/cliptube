<template>
    <div class="page-container w-100 h-100 text-wrap">
        <h2 class="my-2 fs-2"></h2>
        <YouTubePlayer :videoId="videoId" ref="YouTubePlayer" />

        <div
            v-for="userClip in userClips"
            :key="userClip.id"
            class="p border border-dark"
            @click="playClip(userClip.clip.start_sec, userClip.clip.end_sec)"
        >
            <div class="fs-6">{{ userClip.id }}</div>
            <div class="fs-6">{{ userClip.clip.title }}</div>
        </div>
        <div>
            <button
                class="btn btn-outline-dark w-50 my-4"
                @click="switchTo('/user/video')"
            >
                戻る
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import YouTubePlayer from "@/components/YouTubePlayerForWatch.vue";
export default {
    components: {
        YouTubePlayer,
    },
    data() {
        return {
            videoId: null,
            startSec: null,
            endSec: null,
            userClips: [],
        };
    },
    created() {
        this.videoId = this.$route.params.hash;
    },
    mounted() {
        setTimeout(() => {
            this.getClips();
        }, 1000);
        // this.getClips();
    },
    methods: {
        async getClips() {
            try {
                const response = await axios.get(
                    "/api/clip/" + this.videoId,
                    {}
                );
                if (response.status === 200) {
                    this.setUserClips(response.data);
                }
            } catch (error) {
                console.error(error);
            }
        },
        setUserClips(userClips) {
            for (const userClip of userClips) {
                this.userClips.push(userClip);
            }
        },
        playClip(startSec, endSec) {
            this.$refs.YouTubePlayer.seekAndPlay(startSec, endSec);
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
