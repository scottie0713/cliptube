<template>
    <div>
        <div id="player"></div>
    </div>
</template>

<script>
export default {
    name: "YouTubePlayer",
    props: {
        videoId: {
            type: String,
            required: true,
        },
        width: {
            type: Number,
            default: 300,
        },
    },
    data() {
        return {
            player: null,
            isReady: false,
            isPlaying: false,
            startSec: null,
            endSec: null,
        };
    },
    mounted() {
        console.log("mounted");
        this.loadYouTubeIframeAPI();
    },
    methods: {
        watchEndSec() {
            setTimeout(() => {
                if (this.player.getCurrentTime() > this.endSec) {
                    this.player.pauseVideo();
                }
                if (this.isPlaying) {
                    this.watchEndSec();
                }
            }, 500);
        },
        loadYouTubeIframeAPI() {
            if (!window.YT) {
                console.log("loadYouTubeIframeAPI 2");
                const tag = document.createElement("script");
                tag.src = "https://www.youtube.com/iframe_api";
                const firstScriptTag =
                    document.getElementsByTagName("script")[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                window.onYouTubeIframeAPIReady = this.onYouTubeIframeAPIReady;
            } else {
                window.onYouTubeIframeAPIReady = this.onYouTubeIframeAPIReady;
                this.onYouTubeIframeAPIReady();
            }
        },
        onYouTubeIframeAPIReady() {
            this.player = new YT.Player("player", {
                width: this.width,
                height: this.calcHeight(this.width),
                videoId: this.videoId,
                playerVars: {
                    controls: 0, // コントロールバーを非表示
                    modestbranding: 1, // YouTubeロゴを非表示
                    rel: 0, // 関連動画を非表示
                    showinfo: 0, // タイトルを非表示
                    fs: 0, // フルスクリーンボタンを非表示
                    iv_load_policy: 3, // アノテーションを非表示
                    cc_load_policy: 0, // 字幕を非表示
                    disablekb: 1, // キーボード操作を無効化
                    autohide: 1, // コントロールの自動非表示
                },
                events: {
                    onReady: this.onPlayerReady,
                    onStateChange: this.onPlayerStateChange,
                },
            });
        },
        onPlayerReady(event) {
            this.isReady = true;
            this.$emit("playerReady");
        },
        onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.ENDED) {
                this.isPlaying = false;
            }
            if (event.data === YT.PlayerState.PLAYING) {
                this.isPlaying = true;
                this.watchEndSec();
            }
            if (event.data === YT.PlayerState.PAUSED) {
                this.isPlaying = false;
            }
        },
        play() {
            if (this.isReady && !this.isPlaying) {
                this.player.playVideo();
            }
        },
        seekAndPlay(startSec, endSec) {
            this.startSec = startSec;
            this.endSec = endSec;
            if (this.isReady) {
                this.player.seekTo(this.startSec);
                this.play();
            }
        },
        setWidth(width) {
            if (this.player) {
                this.player.setSize(width, this.calcHeight(width));
            }
        },
        calcHeight(width) {
            return Math.floor((width / 16) * 9);
        },
    },
    beforeUnmount() {
        console.log("beforeUnmount");
        if (this.player) {
            this.player.stopVideo();
            this.player.destroy();
        }
    },
};
</script>

<style scoped>
/* 必要に応じてスタイルを追加 */
</style>
