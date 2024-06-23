<template>
  <div class="container p-3">
    <h2><button @click="switchTo('Menu')">＜</button>&nbsp;クリップ作成</h2>
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
