<template>
  <div class="app-vue">
    <Header
      :isLoggedIn="isLoggedIn"
      :accountId="accountId"
      @show-login="showLoginModal"
      @show-register="showRegisterModal"
      @logout="logout"
    />
    <LoginModal
      :visible="showLogin"
      @close="showLogin = false"
      @get-user="getUser"
    />
    <RegisterModal
      :visible="showRegister"
      @close="showRegister = false"
      @ger-user="getUser"
    />
    <Main />
  </div>
</template>

<script>
import axios from "axios";
import Header from "@/components/Header.vue";
import LoginModal from "@/components/LoginModal.vue";
import RegisterModal from "@/components/RegisterModal.vue";
import Main from "@/components/Main.vue";

export default {
  components: {
    Header,
    LoginModal,
    RegisterModal,
    Main,
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
          this.setAccountId(response.data.account_id);
        }
      } catch (error) {
        console.error(error);
      }
    },
    logout() {
      this.isLoggedIn = false;
      this.accountId = "";
    },
  },
};
</script>

<style scoped>
.app-vue {
  height: 100%;
}
</style>
