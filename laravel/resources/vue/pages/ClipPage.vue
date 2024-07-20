<template>
    <div>
        <div id="content-top">
            <Header />
            <ClipTitle />
        </div>
        <div style="padding-top: 20px">
            <div class="row">
                <div class="col">
                    <YouTubePlayer
                        v-if="videoId && playerWidth"
                        :videoId="videoId"
                        :width="playerWidth"
                        ref="YouTubePlayer"
                    />
                </div>
                <div
                    id="content-list"
                    class="col"
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
</template>

<script>
import axios from "axios";
import { apiGet, apiPost } from "~js/utils/api.js";
import ClipList from "@/components/ClipList.vue";
import Header from "@/components/Header.vue";
import ClipTitle from "@/components/Clip/Title.vue";
import YouTubePlayer from "@/components/YouTubePlayerForWatch.vue";
export default {
    components: {
        ClipList,
        ClipTitle,
        Header,
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
        };
    },
    created() {
        this.videoId = this.$route.params.hash;
    },
    mounted() {
        this.resize();
        window.addEventListener("resize", this.handleResize);
        apiGet("/api/clip/" + this.videoId, this.setClips, () => {});
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
            }, 300);
        },
        resize() {
            // sm未満の場合
            if (window.innerWidth < 768) {
                this.playerWidth = window.innerWidth;
                this.scrollBoxWidth = window.innerWidth - 40;
                const contentTop = document.getElementById("content-top");
                const contentList = document.getElementById("content-list");
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
#content-list {
    border: 1px solid #666;
    overflow-y: auto;
    margin: 0 20px;
}
</style>
