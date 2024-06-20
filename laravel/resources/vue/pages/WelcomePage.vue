<template>
  <div id="welcome-page">
    <Welcome
      @scrollToLogin="scrollToLogin"
      @scrollToRegister="scrollToRegister"
    />
    <Login @scrollToTop="scrollToTop" />
    <Register @scrollToTop="scrollToTop" />
    <div class="footer"></div>
  </div>
</template>

<script>
import Welcome from "@/components/Welcome.vue";
import Login from "@/components/Login.vue";
import Register from "@/components/Register.vue";

export default {
  name: "WelcomePage",
  components: {
    Welcome,
    Login,
    Register,
  },
  methods: {
    scrollToLogin() {
      // Loginコンポーネントまでスクロールする処理
      const loginElement = document.getElementById("login-section");
      if (loginElement) {
        loginElement.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    },
    scrollToRegister() {
      // Loginコンポーネントまでスクロールする処理
      const loginElement = document.getElementById("register-section");
      if (loginElement) {
        loginElement.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    },
    scrollToTop() {
      window.scrollTo({ top: 0, behavior: "smooth" });
    },
  },
};
</script>

<style scoped>
#welcome-page {
  padding-top: 56px;
}
.footer {
  height: 200px;
}
</style>
