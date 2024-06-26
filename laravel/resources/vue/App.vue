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
    <router-view :userHash="userHash"></router-view>
  </div>
</template>

<script>
import { createApp } from 'vue';
import axios from "axios";
import router from '~js/router';
import Header from "@/components/Header.vue";
import LoginModal from "@/components/LoginModal.vue";
import RegisterModal from "@/components/RegisterModal.vue";

export default {
  name: "App",
  components: {
    Header,
    LoginModal,
    RegisterModal,
  },
  data() {
    return {
      isLoggedIn: false,
      accountId: "",
      userHash: "",
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
          this.userHash = response.data.hash;
        }
      } catch (error) {
        console.error(error);
      }
    },
    logout() {
      this.isLoggedIn = false;
      this.accountId = "";
      this.userHash = "";
    },
  },
};
</script>

<style scoped>
.app-vue {
  height: 100%;
}
</style>
