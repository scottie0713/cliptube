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
    };
  },
  mounted() {
    this.loadYouTubeIframeAPI();
  },
  methods: {
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
        width: "640",
        height: "360",
        videoId: this.videoId,
      });
    },
    getCurrentTime() {
      if (this.player) {
        return this.player.getCurrentTime();
      }
      return 0;
    },
    seekAndPlay(sec) {
      if (this.player) {
        this.player.seekTo(sec);
        this.player.playVideo();
      }
    },
  },
};
</script>

<style scoped>
/* 必要に応じてスタイルを追加 */
</style>