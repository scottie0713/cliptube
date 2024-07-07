<template>
  <div class="w-100 h-100">
    <div class="w-100 bg-dark">
      <Header
        :isLoggedIn="isLoggedIn"
        :accountId="accountId"
        @logout="logout"
      />
    </div>
    <div class="d-flex justify-content-center h-100">
      <div class="flex bg-dark-subtle" style="width:200px" v-if="breakPoint === 'XXL'">
        <LeftAd />
      </div>
      <div class="flex col word-break w-100 h-100 text-light">
        <router-view :userHash="userHash"></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import { createApp } from 'vue';
import axios from "axios";
import router from '~js/router';
import Header from "@/components/Header.vue";
import LeftAd from "@/components/LeftAd.vue";

export default {
  name: "App",
  components: {
    Header,
    LeftAd,
  },
  data() {
    return {
      isLoggedIn: false,
      accountId: "",
      userHash: "",
      showLogin: false,
      showRegister: false,
      maxWidth: 0,
      breakPoint: "",
    };
  },
  created() {
    this.login();
    window.addEventListener('resize', this.checkWindowSize);
    this.checkWindowSize(); // 初回チェック
    this.maxWidth = window.innerWidth;
  },
  mounted() {
  },
  methods: {
    async login() {
      try {
        const response = await axios.post("/api/login", {
          account_id: "kimukimi713",
          password: "kiminori713",
        });
        if (response.status === 200) {
          this.getUser();
        }
      } catch (error) {
      }
    },
    checkIsXXL() {
      console.log("breakPoint", this.breakPoint);
    },
    checkWindowSize() {
      if (window.innerWidth >= 1400) {
        this.breakPoint = "XXL";
      } else if (window.innerWidth >= 1200 && window.innerWidth < 1400) {
        this.breakPoint = "XL";
      } else if (window.innerWidth >= 992 && window.innerWidth < 1200) {
        this.breakPoint = "LG";
      } else if (window.innerWidth >= 768 && window.innerWidth < 992) {
        this.breakPoint = "MD";
      } else {
        this.breakPoint = "SM";
      }
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
</style>
