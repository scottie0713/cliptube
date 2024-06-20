<template>
  <div id="welcome-section">
    <!-- メインコンテンツ -->
    <div class="container mt-5 component-container">
      <div class="row">
        <div class="col text-center">
          <h1 class="display-4">Cliptube</h1>
          <p class="lead">
            あなたのお気に入りのシーンを簡単に保存して共有しましょう！
          </p>
          <div class="btn btn-outline-success me-2" @click="scrollToRegister()">
            新規登録
          </div>
          <button class="btn btn-outline-primary" @click="scrollToLogin()">
            ログイン
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      currentComponent: null,
    };
  },
  methods: {
    scrollToLogin() {
      console.log("L");
      this.$emit("scrollToLogin");
    },
    scrollToRegister() {
      console.log("R");
      this.$emit("scrollToRegister");
    },
  },
};
</script>

<style scoped>
/* ここにスタイルを追加 */
</style>
