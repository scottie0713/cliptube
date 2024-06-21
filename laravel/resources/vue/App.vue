<template>
  <div id="app">
    <Header
      :isLoggedIn="isLoggedIn"
      :accountId="accountId"
      @show-login="showLoginModal"
      @show-register="showRegisterModal"
    />
    <LoginModal :visible="showLogin" @close="showLogin = false" />
    <RegisterModal :visible="showRegister" @close="showRegister = false" />
    <Menu />
  </div>
</template>

<script>
import axios from "axios";
import Header from "@/components/Header.vue";
import LoginModal from "@/components/LoginModal.vue";
import RegisterModal from "@/components/RegisterModal.vue";
import Menu from "@/components/Menu.vue";

export default {
  components: {
    Header,
    LoginModal,
    RegisterModal,
    Menu,
  },
  data() {
    return {
      isLoggedIn: false,
      accountId: "",
      showLogin: false,
      showRegister: false,
    };
  },
  methods: {
    showLoginModal() {
      this.showLogin = true;
    },
    showRegisterModal() {
      this.showRegister = true;
    },
    setAccountId(accountId) {
      this.isLoggedIn = true;
      this.accountId = accountId;
    },
    async getUser() {
      try {
        const response = await axios.get("/api/user");
        if (response.status === 200) {
          console.log(response);
          this.setAccountId(response.data.account_id);
        }
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>

<style scoped>
#app {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
</style>
