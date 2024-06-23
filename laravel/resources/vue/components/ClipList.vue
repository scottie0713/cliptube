<template>
  <div class="container">
    <h2>クリップ一覧</h2>
    <p>クリップした動画の一覧です</p>
    <button class="btn btn-outline-light" @click="switchTo('Menu')">
      戻る
    </button>
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
.container {
  width: 100%;
  height: 100%;
  text-align: center;
  padding: 20px;
}
</style>
