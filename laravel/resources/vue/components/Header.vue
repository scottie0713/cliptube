<template>
    <header class="header px-4 py-5">
        <div class="title">
            <img src="../../images/title.png" width="240" />
            <div v-if="user.isLogin" class="area-clip fs-6 mb-4">
                {{ user.provider }}でログイン中
            </div>
        </div>
    </header>
</template>

<script>
import axios from "axios";
export default {
    props: {},
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
        async logout() {
            const response = await axios.post("/api/logout");
            this.goToPage("/");
        },
    },
};
</script>

<style scoped>
.header {
    width: 100%;
    height: 200px;
    background-color: #1d2023;
    color: aliceblue;
}

.title {
    width: 100%;
    height: 100%;
    margin: auto 0;
    /* background-image: url("../..//images/title.png");
    background-size: cover;
    background-position: center; */
}
</style>
