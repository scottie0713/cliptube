<template>
  <div id="register-section" class="container mt-5 component-container">
    <div class="row justify-content-center">
      <div class="col text-center">
        <h2>アカウント登録</h2>
        <form @submit.prevent="register">
          <div class="mb-3">
            <label for="registerUsername" class="form-label"
              >アカウントID</label
            >
            <input
              type="text"
              class="form-control"
              id="registerUsername"
              v-model="username"
              required
            />
          </div>
          <div class="mb-3">
            <label for="registerPassword" class="form-label">パスワード</label>
            <input
              type="password"
              class="form-control"
              id="registerPassword"
              v-model="password"
              required
            />
          </div>
          <button type="submit" class="btn btn-success my-20">登録</button>
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
    register() {
      // 新規登録処理
      alert(`登録: ${this.username}`);
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
