<template>
    <div>
        <div id="content-top">
            <Header :user="user" />
            <ClipTitle :title="videoTitle" />
        </div>
        <div style="padding-top: 20px">
            <div class="row g-0">
                <div
                    id="youtube-container"
                    class="col col-12 col-sm-12 col-md-8 col-lg-8 mb-2"
                >
                    <div>
                        <YouTubePlayer
                            v-if="videoId && playerWidth"
                            :videoId="videoId"
                            :width="playerWidth"
                            ref="YouTubePlayer"
                            @playerReady="playerReady"
                        />
                    </div>
                </div>
                <div
                    id="clip-container"
                    class="col col-12 col-sm-12 col-md-4 col-lg-4 mb-2"
                >
                    <div class="mx-2 bg-light p-1">
                        <div
                            class="bg-light text-dark fw-bold text-center py-2"
                            style="font-size: 0.8rem"
                        >
                            クリップ一覧
                        </div>
                        <div id="clip-list" class="p-1 bg-dark">
                            <ClipList :clips="clips" @playClip="playClip" />
                        </div>
                    </div>
                </div>
                <div class="mx-2">
                    <div class="col col-12 col-sm-12 col-md-4 col-lg-4">
                        <ShareToTwitter
                            :text="`${videoTitle} のお気に入りシーンをY-Clippersで作りました。`"
                            :url="`https://y-clippers.net/clip/${videoId}`"
                        />
                    </div>
                    <div class="my-2 col col-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="btn btn-secondary btn-to-edit" @click="$router.push(`/clip/${videoId}/edit`)">
                            編集
                        </div>
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
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            videoId: null,
            startSec: null,
            endSec: null,
            playerWidth: null,
            isPlayerReady: false,
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
        this.handleResize();
        window.addEventListener("resize", this.handleResize);
    },
    methods: {
        playerReady() {
            this.isPlayerReady = true;
        },
        getYouTubeContainerWidth() {
            const youtubeContainer =
                document.getElementById("youtube-container");
            this.playerWidth = youtubeContainer.clientWidth;
        },
        handleResize() {
            if (this.isResizeCoolDown) {
                return;
            }
            this.isResizeCoolDown = true;
            this.getYouTubeContainerWidth();
            if (this.isPlayerReady) {
                this.$refs.YouTubePlayer.setWidth(this.playerWidth);
            }
            setTimeout(() => {
                this.isResizeCoolDown = false;
            }, 100);
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
.btn-to-edit {
    cursor: pointer;
    font-size: 0.8rem;
    background-color: aa6;
    border-radius: 0.8rem;
    padding: 0.5rem;
}
</style>
