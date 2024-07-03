<template>
    <div class="edit-clip-form-container">
        <YouTubePlayer :videoId="videoId" ref="YouTubePlayer" />
        <div class="text-center px-2">
            <div class="edit-clip-form-control">
                <div class="btn-group w-100 mb-2 fs-5">
                    <button @click="relativeSeek(-60)" class="btn btn-light">
                        -1m
                    </button>
                    <div class="vr"></div>
                    <button @click="relativeSeek(-10)" class="btn btn-light">
                        -10s
                    </button>
                    <div class="vr"></div>
                    <button @click="relativeSeek(-1)" class="btn btn-light">
                        -1s
                    </button>
                    <div class="vr"></div>
                    <button
                        v-if="isPlay"
                        @click="pause"
                        class="btn btn-light pause"
                    >
                        <Pause :width="'20px'" :height="'20px'" />
                    </button>
                    <button v-else @click="play" class="btn btn-light play">
                        <Play :width="'20px'" :height="'20px'" />
                    </button>
                    <div class="vr"></div>
                    <button @click="relativeSeek(1)" class="btn btn-light">
                        +1s
                    </button>
                    <div class="vr"></div>
                    <button @click="relativeSeek(10)" class="btn btn-light">
                        +10s
                    </button>
                    <div class="vr"></div>
                    <button @click="relativeSeek(60)" class="btn btn-light">
                        +1m
                    </button>
                </div>

                <div class="btn-group w-100">
                    <button
                        @click="setStartSec"
                        class="flex-fill btn btn-light"
                    >
                        開始時間にセット
                    </button>
                    <div class="vr"></div>
                    <button @click="setEndSec" class="flex-fill btn btn-light">
                        終了時間にセット
                    </button>
                </div>
            </div>

            <div class="d-flex fs-6 mt-1 justify-content-center w-100">
                <div class="flex-fill">
                    {{ timeFormat(startSec) }}
                </div>
                <div class="flex-fill">~</div>
                <div class="flex-fill">{{ timeFormat(endSec) }}</div>
            </div>

            <div class="fs-6">▽わかるように簡単にメモをつけてください</div>
            <input
                type="text"
                v-model="title"
                id="title"
                placeholder="クリップメモ"
            />

            <div class="mt-3">
                <button @click="playClip" class="btn btn-success">再生</button>
                <button @click="postClip" class="btn btn-success">保存</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { timeHelper } from "~js/helpers/timeHelper.js";
import YouTubePlayer from "@/components/YouTubePlayer.vue";
import Pause from "@/components/Parts/Pause.vue";
import Play from "@/components/Parts/Play.vue";

export default {
    props: {
        videoId: {
            type: String,
            required: true,
        },
        videoSec: {
            type: Number,
            required: false,
        },
    },
    components: {
        YouTubePlayer,
        Pause,
        Play,
    },
    mixins: [timeHelper],
    data() {
        return {
            isPlay: false,
            title: "",
            startSec: 0,
            endSec: 0,
        };
    },
    methods: {
        setStartSec() {
            this.startSec = Math.floor(
                this.$refs.YouTubePlayer.getCurrentTime()
            );
        },
        setEndSec() {
            this.endSec = Math.floor(this.$refs.YouTubePlayer.getCurrentTime());
        },
        gainStartSecond() {
            this.start = this.start + 1;
        },
        reduceStartSecond() {
            if (this.start > 0) {
                this.start = this.start - 1;
            }
        },
        gainEndSecond() {
            this.end = this.end + 1;
        },
        reduceEndSecond() {
            if (this.end > 0) {
                this.end = this.end - 1;
            }
        },
        setForm(clip) {
            this.title = clip.title;
            this.startSec = clip.start_sec;
            this.endSec = clip.end_sec;
        },
        playClip() {
            this.$refs.YouTubePlayer.seek(this.startSec);
            this.$refs.YouTubePlayer.play();
        },
        async postClip() {
            try {
                const response = await axios.post("/api/clip", {
                    video_id: this.videoId,
                    start_sec: this.startSec,
                    end_sec: this.endSec,
                    title: this.title,
                });
                if (response.status === 200) {
                    this.$emit("getClips");
                }
            } catch (error) {
                console.error(error);
            }
        },
        // Youtubeプレイヤー操作系
        async pause() {
            if (this.$refs.YouTubePlayer.pause()) {
                this.isPlay = false;
            }
        },
        async play() {
            if (this.$refs.YouTubePlayer.play()) {
                this.isPlay = true;
            }
        },
        async seek(sec) {
            this.$refs.YouTubePlayer.seek(sec);
        },
        async relativeSeek(sec) {
            this.$refs.YouTubePlayer.relativeSeek(sec);
        },
    },
};
</script>

<style scoped>
.vr {
    width: 2px;
}
/* .play {
    background-image: url("../../images/play.svg");
}
.pause {
    background-image: url("../../images/pause.svg");
} */

.edit-clip-form-control button {
    height: 2em;
    line-height: 1em;
}

.btn-narrow {
    width: 2em;
}

input {
    width: 100%;
    height: 2em;
}
</style>
