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
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    methods: {
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
