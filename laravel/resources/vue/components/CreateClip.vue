<template>
  <div class="container">
    <div class="back-to-menu" @click="switchTo('Menu')">&#9650;</div>
    <Search @set-movie="setMovie" />
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
    this.$emit("closeLoading");
  },
  methods: {
    switchTo(component) {
      this.$emit("switchTo", component);
    },
    setMovie(videoId) {
      this.videoId = videoId;
    },
  },
};
</script>

<style scoped>
.container {
  border-radius: 20px;
  white-space: nowrap;
}

.back-to-menu {
  position: absolute;
  top: 20px;
  left: 20px;
  font-size: 2em;
  cursor: pointer;
}
</style>
