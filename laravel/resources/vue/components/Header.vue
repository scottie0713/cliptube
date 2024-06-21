<template>
  <header class="header">
    <div class="container">
      <div class="auth">
        <button
          class="btn btn-outline-light btn-sm mx-2"
          v-if="!isLoggedIn"
          @click="showLogin"
        >
          Login
        </button>
        <button
          class="btn btn-outline-light btn-sm mx-2"
          v-if="!isLoggedIn"
          @click="showRegister"
        >
          Register
        </button>
        <span v-else>{{ accountId }}</span>
      </div>
    </div>
  </header>
</template>

<script>
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
  },
};
</script>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem;
  background-color: #333;
  color: white;
}

/* .header .brand {
  font-size: 1.5rem;
} */

/* .header .auth button {
  margin-left: 1rem;
  background-color: #007bff;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  cursor: pointer;
}

.header .auth button:hover {
  background-color: #0056b3;
} */
</style>
