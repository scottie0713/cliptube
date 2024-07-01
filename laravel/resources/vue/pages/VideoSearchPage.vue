<template>
  <div class="page-container w-100 h-100 text-wrap">
    <h2 class="my-2 fs-2">
      <button @click="goToPage('/')">＜</button
      >&nbsp;クリップする動画を探しましょう
    </h2>
    <hr />
    <VideoSearch />
  </div>
</template>

<script>
import VideoSearch from "@/components/VideoSearch.vue";

export default {
  components: {
    VideoSearch,
  },
  data() {
    return {
      videoId: "",
    };
  },
  mounted() {
  },
  methods: {
    goToPage(path) {
      this.$router.push(path);
    },
    setMovie(videoId) {
      this.videoId = videoId;
    },
  },
};
</script>

<style scoped>
h2 {
  text-align: center;
}

hr {
  border: 1px solid #ffffff;
}

h2 button {
  background: none;
  border: none;
  color: aliceblue;
  font-size: 1em;
  cursor: pointer;
}
</style>
