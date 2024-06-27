<template>
    <div class="page-content">
      <span class="close" @click="close">&times;</span>
      <h2>アカウント新規登録</h2>
      <form @submit.prevent="register">
        <div class="mb-3">
          <label for="account_id" class="form-label">アカウントID:</label>
          <input
            type="text"
            id="account_id"
            class="form-control"
            v-model="accountId"
            required
          />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">パスワード:</label>
          <input
            type="password"
            id="password"
            class="form-control"
            v-model="password"
            required
          />
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label"
            >パスワード（確認）:</label
          >
          <input
            type="password"
            id="password_confirmation"
            class="form-control"
            v-model="passwordConfirmation"
            required
          />
        </div>

        <div class="mt-4">
          <p v-if="errorMessage" style="color: red">{{ errorMessage }}</p>
          <button type="submit" class="btn btn-primary">登録</button>
        </div>
      </form>
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
          this.$emit("close");
          this.$emit("getUser");
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
    close() {
      this.$emit("close");
    },
  },
};
</script>

<style scoped>
.page-content {
  color: aliceblue;
  background-color: #333;
  padding: 4rem;
  margin: 2rem;
  border-radius: 0.5rem;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.close {
  position: absolute;
  top: 0rem;
  right: 1rem;
  font-size: 2rem;
  cursor: pointer;
}
</style>
