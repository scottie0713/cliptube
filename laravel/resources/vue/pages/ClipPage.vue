<template>
    <div>
        <div id="content-top">
            <Header />
            <ClipTitle />
        </div>
        <div style="padding-top: 20px">
            <div class="row">
                <div class="col">
                    <div>
                        <YouTubePlayer
                            v-if="videoId && playerWidth"
                            :videoId="videoId"
                            :width="playerWidth"
                            ref="YouTubePlayer"
                        />
                    </div>
                    <div>
                        {{ videoTitle }}
                        <ShareToTwitter
                            :text="videoTitle"
                            :url="`https://clipper.tokyo/watch/${videoId}`"
                        />
                    </div>
                </div>
                <div
                    id="clip-container"
                    class="col"
                    :style="{
                        width: scrollBoxWidth + 'px',
                        margin: '0 20px',
                    }"
                >
                    <div
                        class="bg-secondary p-0 text-center"
                        :style="{
                            width: scrollBoxWidth + 'px',
                            margin: '0 20px',
                        }"
                    >
                        クリップ一覧
                    </div>
                    <div
                        id="clip-list"
                        :style="{
                            height: scrollBoxHeight + 'px',
                            width: scrollBoxWidth + 'px',
                        }"
                    >
                        <ClipList :clips="clips" @playClip="playClip" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { apiGet, apiPost } from "~js/utils/api.js";
import ClipList from "@/components/ClipList.vue";
import Header from "@/components/Header.vue";
import ClipTitle from "@/components/Clip/Title.vue";
import ShareToTwitter from "@/components/ShareToTwitter.vue";
import YouTubePlayer from "@/components/YouTubePlayerForWatch.vue";
export default {
    components: {
        ClipList,
        ClipTitle,
        Header,
        ShareToTwitter,
        YouTubePlayer,
    },
    data() {
        return {
            videoId: null,
            startSec: null,
            endSec: null,
            playerWidth: null,
            scrollBoxWidth: 300,
            scrollBoxHeight: 400,
            isResizeCoolDown: false,
            clips: [],
            videoTitle: "",
        };
    },
    created() {
        this.videoId = this.$route.params.hash;
        apiGet("/api/video/" + this.videoId, this.setVideo, () => {});
        apiGet("/api/clip/" + this.videoId, this.setClips, () => {});
    },
    mounted() {
        this.resize();
        window.addEventListener("resize", this.handleResize);
    },
    methods: {
        handleResize() {
            if (this.isResizeCoolDown) {
                return;
            }
            this.isResizeCoolDown = true;
            this.resize();
            this.$refs.YouTubePlayer.setWidth(this.playerWidth);
            setTimeout(() => {
                this.isResizeCoolDown = false;
            }, 100);
        },
        resize() {
            // sm未満の場合
            if (window.innerWidth < 768) {
                this.playerWidth = window.innerWidth;
                this.scrollBoxWidth = window.innerWidth - 40;
                const contentTop = document.getElementById("content-top");
                const contentList = document.getElementById("clip-container");
                // console.log(
                //     "HEIGHT",
                //     contentTop.offsetHeight,
                //     contentList.offsetHeight
                // );
                this.scrollBoxHeight =
                    window.innerHeight -
                    contentTop.offsetHeight -
                    contentList.offsetHeight -
                    40;
            }
            // md以上の場合
            else {
                this.playerWidth = window.innerWidth - 300;
                this.scrollBoxWidth = 300;
                const contentTop = document.getElementById("content-top");
                // console.log("HEIGHT", contentTop.offsetHeight);
                this.scrollBoxHeight =
                    window.innerHeight - contentTop.offsetHeight - 40;
            }
        },
        setVideo(data) {
            this.videoTitle = data.title;
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
    beforeDestroy() {
        window.removeEventListener("resize", this.handleResize);
    },
};
</script>

<style scoped>
#clip-container {
    border: 1px solid #666;
    margin: 0 20px;
}
#clip-list {
    overflow-y: auto;
}
</style>
