<template>
  <div class="modal" v-if="visible">
    <div class="modal-content">
      <span class="close" @click="close">&times;</span>
      <h2>ログイン</h2>
      <form @submit.prevent="login">
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

        <div class="mt-6">
          <p v-if="errorMessage" style="color: red">{{ errorMessage }}</p>
          <button type="submit" class="btn btn-primary">ログイン</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: ["visible"],
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
.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: white;
  padding: 2rem;
  border-radius: 0.5rem;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.close {
  position: absolute;
  top: 0.5rem;
  right: 0.5rem;
  font-size: 1.5rem;
  cursor: pointer;
}

button {
  width: 100%;
}
</style>