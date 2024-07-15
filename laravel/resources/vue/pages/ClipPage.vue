<template>
    <div>
        <Header />
        <div class="page-container w-100 h-100 text-wrap">
            <h2 class="my-2 fs-2"></h2>
            <YouTubePlayer :videoId="videoId" ref="YouTubePlayer" />

            <div
                id="clip-box"
                class="scroll-box"
                :style="{ height: scrollBoxHeight + 'px' }"
            >
                <div
                    v-for="c in clips"
                    :key="c.id"
                    class="scroll-box-item d-flex flex-row justify-content-start align-items-center gap-2"
                    @click="playClip(c.start_sec, c.end_sec)"
                >
                    <div>
                        {{ timeFormat(c.start_sec) }}~{{
                            timeFormat(c.end_sec)
                        }}
                    </div>
                    <div class="flex-fill justify-content-end">
                        {{ c.title }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { timeHelper } from "~js/helpers/timeHelper.js";
import Header from "@/components/Header.vue";
import YouTubePlayer from "@/components/YouTubePlayerForWatch.vue";
export default {
    components: {
        Header,
        YouTubePlayer,
    },
    mixins: [timeHelper],
    data() {
        return {
            videoId: null,
            startSec: null,
            endSec: null,
            scrollBoxHeight: 400,
            clips: [],
        };
    },
    created() {
        this.videoId = this.$route.params.hash;
    },
    mounted() {
        // BOXの高さ調整
        const box = document.getElementById("clip-box");
        console.log("BOX", box.offsetHeight);
        console.log("WINDOW", window.innerHeight);
        this.scrollBoxHeight = window.innerHeight - box.offsetHeight - 40;

        setTimeout(() => {
            this.getClips();
        }, 1000);
    },
    methods: {
        async getClips() {
            try {
                const response = await axios.get(
                    "/api/clip/" + this.videoId,
                    {}
                );
                if (response.status === 200) {
                    this.setClips(response.data);
                }
            } catch (error) {
                console.error(error);
            }
        },
        setClips(clips) {
            for (const c of clips) {
                this.clips.push(c);
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

.scroll-box {
    border: 1px solid #666;
    overflow-y: auto;
}

.scroll-box-item {
    color: #333;
    background-color: #f0f0f0;
    border: 1px solid #bbb;
    font-size: 1rem;
    padding: 0.5rem;
    margin: 0.2rem 0;
    cursor: pointer;
}
</style>
