<template>
    <div class="w-100 h-100" style="min-width: 360px">
        <div class="d-flex justify-content-center h-100">
            <div
                class="flex bg-dark-subtle"
                style="width: 200px"
                v-if="breakPoint === 'XXL'"
            >
                <LeftAd />
            </div>
            <div class="flex col word-break w-100 h-100 text-light">
                <router-view :user="user"></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import { createApp } from "vue";
import { apiGet, apiPost } from "~js/utils/api.js";
import axios from "axios";
import router from "~js/router";
import LeftAd from "@/components/LeftAd.vue";

export default {
    name: "App",
    components: {
        LeftAd,
    },
    data() {
        return {
            user: {
                isLogin: false,
                accountId: "",
                provider: "",
                hash: "",
            },
            maxWidth: 0,
            breakPoint: "",
        };
    },
    created() {
        window.addEventListener("resize", this.checkWindowSize);
        this.checkWindowSize(); // 初回チェック
        this.maxWidth = window.innerWidth;
        apiGet("/api/user", this.loggedInCallback, () => {});
    },
    mounted() {},
    methods: {
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
        loggedInCallback(response) {
            this.user.isLogin = true;
            this.user.provider = response.provider;
        },
    },
};
</script>

<style scoped></style>
