<template>
  <div>
    <h1>Cliptube</h1>
    <form @submit.prevent="login">
      <div>
        <label for="account_id">アカウントID:</label>
        <input type="text" id="account_id" v-model="accountId" />
      </div>
      <div>
        <label for="password">パスワード:</label>
        <input type="password" id="password" v-model="password" />
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      username: "",
      accountId: "",
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post("/login", {
          accountId: this.accountId,
          password: this.password,
        });
        if (response.status === 200) {
          // ログイン成功時の処理
          this.isLoggedIn = true;
          // ログイン成功後に特定のルートにリダイレクト
          this.$router.push("/dashboard"); // 例: ダッシュボードページへのリダイレクト
        } else {
          // ログイン失敗時の処理
          alert("Login failed");
        }
      } catch (error) {
        // エラーハンドリング
        console.error("Error during login:", error);
        alert("An error occurred during login");
      }
    },
  },
};
</script>

<style scoped>
/* 必要に応じてスタイルを追加 */
h1 {
  color: #333;
}
form {
  margin-top: 20px;
}
div {
  margin-bottom: 10px;
}
</style>
