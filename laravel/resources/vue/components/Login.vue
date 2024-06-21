<template>
  <div id="login-section" class="container mt-5 component-container">
    <div class="row justify-content-center">
      <div class="col text-center">
        <h2>ログイン</h2>
        <form @submit.prevent="login">
          <div class="mb-3">
            <p v-if="errorMessage" style="color: red">{{ errorMessage }}</p>
            <label for="loginAccountId" class="form-label">アカウントID</label>
            <input
              type="text"
              class="form-control"
              id="loginAccountId"
              v-model="accountId"
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
import axios from "axios";
export default {
  data() {
    return {
      accountId: "",
      password: "",
      errorMessage: "",
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post("/api/login", {
          account_id: this.accountId,
          password: this.password,
        });
        if (response.status === 200) {
          this.$router.push("/member");
        }
      } catch (error) {
        // エラーハンドリング
        if (error.response) {
          console.error(error.response.data);
          this.errorMessage = error.response.data; // API からのエラーメッセージを表示
        } else if (error.request) {
          console.error("No response received:", error.request);
          this.errorMessage = "応答がありません"; // レスポンスがない場合のエラー処理
        } else {
          console.error("Error setting up request:", error.message);
          this.errorMessage = "Request setup error."; // リクエスト設定時のエラー処理
        }
      }
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
