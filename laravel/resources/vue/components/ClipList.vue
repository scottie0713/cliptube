<template>
  <div class="clip-list-container">
    <h2>クリップ一覧</h2>
    <p>クリップした動画の一覧です</p>
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
  methods: {},
};
</script>

<style scoped>
.clip-list-container {
  width: 100%;
  height: 100%;
  text-align: center;
  padding: 20px;
}
</style>
