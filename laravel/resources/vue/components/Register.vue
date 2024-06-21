<template>
  <div id="register-section" class="container mt-5 component-container">
    <div class="row justify-content-center">
      <div class="col text-center">
        <h2>アカウント登録</h2>
        <form @submit.prevent="register">
          <div class="mb-3">
            <label for="registerAccountId" class="form-label"
              >アカウントID</label
            >
            <p v-if="errorMessage" style="color: red">{{ errorMessage }}</p>
            <input
              type="text"
              class="form-control"
              id="registerAccountId"
              v-model="accountId"
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
          <div class="mb-3">
            <label class="form-label">確認のためもう一度入力</label>
            <input
              type="password"
              class="form-control"
              id="registerPasswordConfirmation"
              v-model="passwordConfirmation"
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
import axios from "axios";
export default {
  data() {
    return {
      accountId: "",
      password: "",
      passwordConfirmation: "",
      errorMessage: "",
    };
  },
  methods: {
    async register() {
      try {
        const response = await axios.post("/api/register", {
          account_id: this.accountId,
          password: this.password,
          password_confirmation: this.passwordConfirmation,
        });
        if (response.status === 200) {
          // 登録成功後の処理
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
