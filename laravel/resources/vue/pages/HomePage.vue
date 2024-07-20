<template>
    <div class="p-4">
        <div class="row">
            <!-- タイトルヘッダ -->
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <HomeTitle />
            </div>
            <!-- タイトルヘッダ -->

            <!-- ログインについて -->
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <HomeLogin :isLogin="isLogin" :loginProvider="loginProvider" />
            </div>
        </div>
        <!-- /ログインについて -->

        <!-- メニュー -->
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                <HomeMenu
                    imageName="ImageScissors"
                    :isEnable="isLogin"
                    :menuTitle="
                        isLogin
                            ? '動画を検索してクリップ作成'
                            : '動画を検索してクリップ作成（要ログイン）'
                    "
                    backgroundColor="#c75c5c"
                    linkPath="/youtube/search"
                />
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                <HomeMenu
                    imageName="ImageClip"
                    :isEnable="isLogin"
                    :menuTitle="
                        isLogin
                            ? '自分の作ったクリップを見る'
                            : '自分の作ったクリップを見る（要ログイン）'
                    "
                    backgroundColor="#c7b95c"
                    linkPath="/video/list/my"
                />
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                <HomeMenu
                    imageName="ImageSearchOrange"
                    :menuTitle="'クリップを検索'"
                    backgroundColor="#e0995e"
                    linkPath="/video/list"
                />
            </div>
        </div>
        <!-- /メニュー -->
    </div>
</template>

<script>
import axios from "axios";
import { apiGet, apiPost } from "~js/utils/api.js";
import HomeLogin from "@/components/Home/Login.vue";
import HomeMenu from "@/components/Home/Menu.vue";
import HomeTitle from "@/components/Home/Title.vue";

export default {
    components: {
        HomeLogin,
        HomeMenu,
        HomeTitle,
    },
    props: [],
    data() {
        return {
            isLogin: false,
            loginProvider: "",
        };
    },
    created() {
        apiGet("/api/user", this.loggedIn, () => {});
    },
    mounted() {},
    methods: {
        loggedIn(response) {
            this.isLogin = true;
            this.loginProvider = response.provider;
        },
    },
};
</script>

<style scoped></style>
