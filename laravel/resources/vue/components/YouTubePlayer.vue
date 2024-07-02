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
    },
    data() {
        return {
            player: null,
            width: 640,
            height: 360,
        };
    },
    mounted() {
        this.setPlayerSize();
        this.loadYouTubeIframeAPI();
    },
    methods: {
        setPlayerSize() {
            // 横幅は画面いっぱいに広げる 最大幅は1024px
            this.width = Math.min(window.innerWidth, 1024);
            // 立幅は横幅の16:9
            this.height = (this.width * 9) / 16;
        },
        loadYouTubeIframeAPI() {
            if (!window.YT) {
                const tag = document.createElement("script");
                tag.src = "https://www.youtube.com/iframe_api";
                const firstScriptTag =
                    document.getElementsByTagName("script")[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                window.onYouTubeIframeAPIReady = this.onYouTubeIframeAPIReady;
            } else {
                this.onYouTubeIframeAPIReady();
            }
        },
        onYouTubeIframeAPIReady() {
            this.player = new YT.Player("player", {
                width: this.width,
                height: this.height,
                videoId: this.videoId,
                playerVars: {
                    controls: 1, // コントロールバーを表示
                    modestbranding: 1, // YouTubeロゴを非表示
                    rel: 0, // 関連動画を非表示
                    showinfo: 0, // タイトルを非表示
                    fs: 0, // フルスクリーンボタンを非表示
                    iv_load_policy: 3, // アノテーションを非表示
                    cc_load_policy: 0, // 字幕を非表示
                    disablekb: 1, // キーボード操作を無効化
                    autohide: 1, // コントロールの自動非表示
                },
            });
        },
        getCurrentTime() {
            if (this.player) {
                return this.player.getCurrentTime();
            }
            return 0;
        },
        play() {
            if (this.player) {
                this.player.playVideo();
                return true;
            }
            return false;
        },
        pause() {
            if (this.player) {
                this.player.pauseVideo();
                return true;
            }
            return false;
        },
        seek(sec) {
            if (this.player) {
                this.player.seekTo(sec);
                return true;
            }
            return false;
        },
        seekAndPlay(sec) {
            if (this.player) {
                this.player.seekTo(sec);
                this.player.playVideo();
                return true;
            }
            return false;
        },
        relativeSeek(sec) {
            if (this.player) {
                this.player.seekTo(this.player.getCurrentTime() + sec, true);
                return true;
            }
            return false;
        },
        relativeSeekAndPlay(sec) {
            if (this.player) {
                this.player.seekTo(this.player.getCurrentTime() + sec, true);
                this.player.playVideo();
                return true;
            }
            return false;
        },
    },
};
</script>

<style scoped>
/* 必要に応じてスタイルを追加 */
</style>
