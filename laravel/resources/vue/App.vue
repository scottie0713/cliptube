<template>
    <div class="w-100 h-100" style="min-width: 360px">
        <div class="d-flex justify-content-center h-100">
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

export default {
    name: "App",
    data() {
        return {
            user: {
                isLogin: false,
                accountId: "",
                provider: "",
                hash: "",
            },
        };
    },
    created() {
        apiGet("/api/user", this.loggedInCallback, () => {});
    },
    mounted() {},
    methods: {
        loggedInCallback(response) {
            this.user.isLogin = true;
            this.user.provider = response.provider;
            this.user.providerName = response.providerName;
            this.user.hash = response.hash;
            this.user.name = response.name;
        },
    },
};
</script>
