<template>
    <div class="p-4">
        <div class="row">
            <!-- タイトルヘッダ -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <HomeTitle />
            </div>
            <!-- タイトルヘッダ -->
        </div>
        <!-- /ログインについて -->

        <!-- このサービスについて -->
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <HomeAbout
                    number="1"
                    title="本家より気軽に疑似的にクリップ"
                    desc="YouTube動画のお気に入りシーンを保存するクリップ機能。本家よりも簡単・一気に作成。（実際に動画を切り抜くことはせず動画時間を保存します）"
                />
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <HomeAbout
                    number="2"
                    title="クリップをまとめてプレイリストに"
                    desc="動画をまたいでもOK。保存したクリップを群としてまとめて連続再生。"
                />
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <HomeAbout
                    number="3"
                    title="他人にも共有"
                    desc="作ったプレイリストはURLをシェアすれば誰でも再生可能。"
                />
            </div>
        </div>
        <!-- /このサービスについて -->
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                <HomeLogin :user="user" />
            </div>
        </div>

        <!-- メニュー -->
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                <HomeMenu
                    imageName="ImageScissors"
                    :isEnable="user.isLogin"
                    menuTitle="動画を検索してクリップ作成"
                    backgroundColor="#c75c5c"
                    linkPath="/youtube/search"
                />
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                <HomeMenu
                    imageName="ImageClip"
                    :isEnable="user.isLogin"
                    menuTitle="自分の作ったクリップを見る"
                    backgroundColor="#c7b95c"
                    linkPath="/video/list/my"
                />
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                <HomeMenu
                    imageName="ImageVideoStory"
                    :isEnable="user.isLogin"
                    menuTitle="プレイリスト作成"
                    backgroundColor="#5ca3c7"
                    :linkPath="`/playlist/${user.hash}`"
                />
            </div>
        </div>
        <!-- /メニュー -->
    </div>
</template>

<script>
import axios from "axios";
import { apiGet, apiPost } from "~js/utils/api.js";
import HomeAbout from "@/components/Home/About.vue";
import HomeLogin from "@/components/Home/Login.vue";
import HomeMenu from "@/components/Home/Menu.vue";
import HomeTitle from "@/components/Home/Title.vue";

export default {
    components: {
        HomeAbout,
        HomeLogin,
        HomeMenu,
        HomeTitle,
    },
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            // isLogin: false,
            // loginProvider: "",
        };
    },
    created() {
        // apiGet("/api/user", this.loggedIn, () => {});
    },
    mounted() {},
    methods: {
        // loggedIn(response) {
        //     this.isLogin = true;
        //     this.loginProvider = response.provider;
        // },
    },
};
</script>

<style scoped></style>
