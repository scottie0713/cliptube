<template>
  <div
    class="edit-clip-controller-container text-center bg-light"
  >
    <div class="player-control d-flex justify-content-center">
      <button @click="relativeSeekAndPlay(-30)" class="flex-fill btn">
        &lt;&nbsp;30秒
      </button>
      <div class="vr"></div>
      <button @click="relativeSeekAndPlay(-5)" class="flex-fill btn ">
        &lt;&nbsp;5秒
      </button>
      <div class="vr"></div>
      <button v-if="isPlay" @click="pause" class="flex-fill btn">
        PAUSE
      </button>
      <button v-else @click="play" class="flex-fill btn">
        PLAY
      </button>
      <div class="vr"></div>
      <button @click="relativeSeekAndPlay(5)" class="flex-fill btn">
        5秒&nbsp;&gt;
      </button>
      <div class="vr"></div>
      <button @click="relativeSeekAndPlay(30)" class="flex-fill btn">
        30秒&nbsp;&gt;
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
  },
  components: {
  },
  data() {
    return {
      isPlay: false,
    };
  },
  created() {
  },
  mounted() {
  },
  methods: {
    pause() {
      this.isPlay = false;
      this.$emit("pause");
    },
    play() {
      this.isPlay = true;
      this.$emit("play");
    },
    relativeSeekAndPlay(sec) {
      this.$emit("relativeSeekAndPlay", sec);
    },
  },
};
</script>

<style scoped>
.edit-clip-controller-container {
  border: 1px solid #ccc;
}
</style>
