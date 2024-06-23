<template>
  <div class="about-container w-100 h-100 text-wrap">
    <h2 class="">Cliptubeについて</h2>
    <div>
      <p>Cliptubeは、YouTubeの動画をクリップして保存できるサービスです。</p>
      <p>
        お気に入りの動画の一部を切り取って保存し、いつでも見返すことができます。
      </p>
      <p>また、クリップした動画を他のユーザーと共有することもできます。</p>
      <button class="btn btn-outline-light" @click="switchTo('Menu')">
        戻る
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  mounted() {
    this.$emit("closeLoading");
  },
  methods: {
    switchTo(component) {
      this.$emit("switchTo", component);
    },
  },
};
</script>

<style scoped>
.about-container {
  text-align: center;
}
.p {
  margin: 10px auto;
  padding: 20px;
}
</style>
