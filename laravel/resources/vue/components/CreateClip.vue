<template>
  <div class="container">
    <div class="back-to-menu" @click="switchTo('Menu')">&#9650;</div>
    <Search />
    <!-- <EditClip v-if="movieId !== ''" :movieId="movieId" /> -->
  </div>
</template>

<script>
// import EditClip from "@/components/CreateClip/EditClip.vue";
import Search from "@/components/CreateClip/Search.vue";

export default {
  components: {
    // EditClip,
    Search,
  },
  data() {
    return {
      movieId: "",
    };
  },
  mounted() {
    this.$emit("closeLoading");
  },
  methods: {
    switchTo(component) {
      this.$emit("switchTo", component);
    },
    setMovie(movieId) {
      this.movieId = movieId;
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
