<template>
  <header class="header py-2 pl-4 pr-2">
    <div class="container">
      <span class="mx-4">つべくりっぷ</span>
      <div v-if="!isLoggedIn">
        <span class="mx-2">ゲストさん</span>
        <button class="btn btn-outline-light btn-sm mx-2" @click="showLogin">
          ログイン
        </button>
        <button class="btn btn-outline-light btn-sm mx-2" @click="showRegister">
          新規登録
        </button>
      </div>
      <div v-else>
        <span>{{ accountId }}さん</span>
        <button class="btn btn-outline-light btn-sm mx-2" @click="logout">
          ログアウト
        </button>
      </div>
    </div>
  </header>
</template>

<script>
import axios from "axios";
export default {
  props: {
    isLoggedIn: Boolean,
    accountId: String,
  },
  methods: {
    showLogin() {
      this.$emit("show-login");
    },
    showRegister() {
      this.$emit("show-register");
    },
    async logout() {
      const response = await axios.post("/api/logout");
      this.$emit("logout");
    },
  },
};
</script>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  background-color: #333;
  color: aliceblue;
}
</style>
