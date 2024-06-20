<template>
  <div id="login-section" class="container mt-5 component-container">
    <div class="row justify-content-center">
      <div class="col text-center">
        <h2>ログイン</h2>
        <form @submit.prevent="login">
          <div class="mb-3">
            <label for="loginUsername" class="form-label">アカウントID</label>
            <input
              type="text"
              class="form-control"
              id="loginUsername"
              v-model="username"
              required
            />
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">パスワード</label>
            <input
              type="password"
              class="form-control"
              id="loginPassword"
              v-model="password"
              required
            />
          </div>
          <button type="submit" class="btn btn-primary">ログイン</button>
        </form>
        <button class="btn btn-light my-4" @click="scrollToTop()">戻る</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: "",
      password: "",
    };
  },
  methods: {
    login() {
      // ログイン処理
      alert(`ログイン: ${this.username}`);
    },
    scrollToTop() {
      this.$emit("scrollToTop");
    },
  },
};
</script>

<style scoped>
/* カスタムスタイルが必要ならここに追加 */
</style>
