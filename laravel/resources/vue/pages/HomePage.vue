<template>
    <div class="page-container text-center text-light">
        <header class="header px-4 py-5">
            <div class="title">
                <img src="../../images/title.png" width="240" />
                <div v-if="isLogin" class="area-clip fs-6 mb-4">
                    {{ loginProvider }}でログイン中
                </div>
                <div v-else>
                    <button class="btn btn-primary" @click="goToLogin">
                        ログイン
                    </button>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                <div
                    class="menu-box d-flex justify-content-center align-items-center gap-2 word-break"
                    style="background-color: #c75c5c"
                    @click="goToPage('/video/search')"
                >
                    <div class="menu-icon">
                        <ImageSearch size="36" />
                    </div>
                    <div class="menu-desc flex-fill">
                        動画を検索してクリップ作成
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                <div
                    class="menu-box d-flex justify-content-center align-items-center gap-2 word-break"
                    style="background-color: #c7b95c"
                    @click="goToPage('/video/list/my')"
                >
                    <div class="menu-icon">
                        <ImageClip size="36" />
                    </div>
                    <div class="menu-desc flex-fill">
                        自分の作ったクリップを見る
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                <div
                    class="menu-box d-flex justify-content-center align-items-center gap-2 word-break"
                    style="background-color: #5ca3c7"
                    @click="goToPage('/user/video')"
                >
                    <div class="menu-icon">
                        <ImageVideoStory size="36" />
                    </div>
                    <div class="menu-desc flex-fill">
                        クリップをまとめてプレイリスト作成
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                <div
                    class="menu-box d-flex justify-content-center align-items-center gap-2 word-break"
                    style="background-color: #5ca3c7"
                    @click="goToPage('/video/list')"
                >
                    <div class="menu-icon">
                        <ImageVideoStory size="36" />
                    </div>
                    <div class="menu-desc flex-fill">クリップを検索</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import ImageScissors from "@/components/Images/Scissors.vue";
import ImageVideoStory from "@/components/Images/VideoStory.vue";
import ImageClip from "@/components/Images/Clip.vue";
import ImageSearch from "@/components/Images/Search.vue";

export default {
    components: {
        ImageClip,
        ImageSearch,
        ImageScissors,
        ImageVideoStory,
    },
    props: [],
    data() {
        return {
            isLogin: false,
            loginProvider: "",
        };
    },
    created() {
        this.getUser();
    },
    mounted() {},
    methods: {
        async getUser() {
            try {
                const response = await axios.get("/api/user");
                if (response.status === 200) {
                    this.isLogin = true;
                    this.loginProvider = response.data.provider;
                }
            } catch (error) {
                console.error(error);
            }
        },
        goToPage(path) {
            this.$router.push(path);
        },
        goToLogin() {
            location.href = "/login/twitter";
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

.menu-box {
    margin: 1rem;
    border-radius: 0.5rem;
    padding: 1.4rem;
    color: #fff;
    font-size: 1.2rem;
    cursor: pointer;
}

.menu-icon {
    margin: 0.2rem 0;
}

.menu-desc {
    font-size: 1rem;
    color: #fff;
    text-align: left;
}
</style>
