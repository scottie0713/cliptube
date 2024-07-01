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
        const firstScriptTag = document.getElementsByTagName("script")[0];
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
      }
    },
    pause() {
      if (this.player) {
        this.player.pauseVideo();
      }
    },
    seekAndPlay(sec) {
      if (this.player) {
        this.player.seekTo(sec);
        this.player.playVideo();
      }
    },
    relativeSeekAndPlay(sec) {
      if (this.player) {
        this.player.seekTo(this.player.getCurrentTime() + sec, true);
        this.player.playVideo();
      }
    },
  },
};
</script>

<style scoped>
/* 必要に応じてスタイルを追加 */
</style>