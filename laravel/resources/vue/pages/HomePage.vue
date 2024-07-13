<template>
    <div class="page-container text-center text-light">
        <Header />

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
                    @click="goToPage('/user/video')"
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
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Header from "@/components/Header.vue";
import ImageScissors from "@/components/Images/Scissors.vue";
import ImageVideoStory from "@/components/Images/VideoStory.vue";
import ImageClip from "@/components/Images/Clip.vue";
import ImageSearch from "@/components/Images/Search.vue";

export default {
    components: {
        Header,
        ImageClip,
        ImageSearch,
        ImageScissors,
        ImageVideoStory,
    },
    props: ["userHash"],
    data() {
        return {};
    },
    mounted() {},
    methods: {
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
.menu-box {
    margin: 1rem;
    border-radius: 0.5rem;
    padding: 1.4rem;
    color: #fff;
    font-size: 1.2rem;
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
