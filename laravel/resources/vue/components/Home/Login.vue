<template>
    <div class="login-box text-center">
        <p>機能はX(旧:Twitter)アカウントでログインして利用できます</p>
        <div v-if="isLogin">
            <div
                v-if="loginProvider == 'X'"
                class="d-flex flex-row align-items-center p-2 gap-2 justify-content-center"
            >
                <div>
                    <img :src="ImageTwitterWhite" width="14" />
                </div>
                <div>でログイン中</div>
                <div>
                    <button class="btn btn-sm btn-secondary" @click="logout">
                        ログアウト
                    </button>
                </div>
            </div>
        </div>
        <div v-else>
            <button class="btn btn-light" @click="login">
                <div
                    class="d-flex flex-row border-circle align-items-center p-2 gap-2"
                >
                    <div>
                        <img :src="ImageTwitterBlack" width="20" />
                    </div>
                    <div>ログイン</div>
                </div>
            </button>
        </div>
    </div>
</template>

<script>
import ImageTwitterBlack from "~images/logo-twitter-black.png";
import ImageTwitterWhite from "~images/logo-twitter-white.png";
export default {
    props: {
        isLogin: {
            type: Boolean,
            required: true,
        },
        loginProvider: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            ImageTwitterBlack: ImageTwitterBlack,
            ImageTwitterWhite: ImageTwitterWhite,
        };
    },
    methods: {
        login() {
            location.href = "/login/twitter";
        },
        logout() {
            location.href = "/logout";
        },
    },
};
</script>

<style scoped>
.login-box {
    margin: 1rem 0;
    border-radius: 0.5rem;
    border: 0.1rem solid #fff;
    padding: 1.4rem;
    font-size: 0.8rem;
}
</style>
