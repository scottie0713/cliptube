<template>
  <div class="page-container w-100 h-100 text-wrap">
    <h2 class="my-2 fs-2">
      <button @click="goToPage('Menu')" class="text-dark">＜</button
      >&nbsp;クリップ作成
    </h2>
    <hr />
    <Search @set-movie="setMovie" />
    <hr v-if="videoId !== ''" />
    <EditClip v-if="videoId !== ''" :videoId="videoId" />
  </div>
</template>

<script>
import EditClip from "@/components/CreateClip/EditClip.vue";
import Search from "@/components/CreateClip/Search.vue";

export default {
  components: {
    EditClip,
    Search,
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
