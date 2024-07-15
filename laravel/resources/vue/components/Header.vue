<template>
    <header class="header px-4 py-4 text-start">
        <div class="d-flex">
            <div class="flex-grow-1">
                <img
                    @click="goToPage('/')"
                    src="../../images/title.png"
                    width="160"
                />
            </div>
            <div class="mb-4 text-end">
                <div v-if="user.isLogin">{{ user.provider }}でログイン中</div>
                <div v-else class="mb-4">未ログイン</div>
            </div>
        </div>
    </header>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            user: {
                isLogin: false,
                provider: "",
            },
        };
    },
    created() {
        this.getUser();
    },
    methods: {
        async getUser() {
            try {
                const response = await axios.get("/api/user");
                if (response.status === 200) {
                    this.user.isLogin = true;
                    this.user.provider = response.data.provider;
                }
            } catch (error) {
                console.error(error);
            }
        },
        goToPage(path) {
            this.$router.push(path);
        },
    },
};
</script>

<style scoped>
.header {
    width: 100%;
    height: 70px;
    background-color: #1d2023;
    color: aliceblue;
    font-size: 1rem;
}

.header img {
    cursor: pointer;
}
</style>
