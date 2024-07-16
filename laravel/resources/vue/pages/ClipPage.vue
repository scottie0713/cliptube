<template>
    <div>
        <Header />
        <div class="page-container w-100 h-100 text-wrap">
            <!-- タイトル -->
            <div
                class="page-title d-flex justify-content-center align-items-center"
            >
                <div>
                    <ImagePlay size="30" />
                </div>
                <div>クリップ再生</div>
            </div>
            <!-- /タイトル -->
            <YouTubePlayer :videoId="videoId" ref="YouTubePlayer" />

            <ClipList :clips="clips" />
        </div>
    </div>
</template>

<script>
import axios from "axios";
import ClipList from "@/components/ClipList.vue";
import ImagePlay from "@/components/Images/Play.vue";
import Header from "@/components/Header.vue";
import YouTubePlayer from "@/components/YouTubePlayerForWatch.vue";
export default {
    components: {
        ClipList,
        Header,
        ImagePlay,
        YouTubePlayer,
    },
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
.page-title {
    background-color: #76c2af;
    margin: 0 auto 1rem auto;
    padding: 0.2em;
    border-radius: 2em;
}

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
