<template>
    <div class="page-container text-center text-light">
        <Header />
        <div class="area-clip fs-6">
            <div class="d-flex flex-row gap-5 py-5">
                <div
                    class="flex-fill menu-item"
                    @click="goToPage('/video/search')"
                >
                    <div class="row justify-content-center">
                        <div class="menu-icon">
                            <img src="../../images/kari01.png" width="80" />
                        </div>
                    </div>
                    <div class="row justify-content-center menu-title">
                        作成
                    </div>
                    <div class="row justify-content-center menu-desc">
                        クリップの作成
                    </div>
                </div>
                <div
                    class="flex-fill menu-item"
                    @click="goToPage('/user/video')"
                >
                    <div class="row justify-content-center">
                        <div class="menu-icon">
                            <img src="../../images/kari01.png" width="80" />
                        </div>
                    </div>
                    <div class="row justify-content-center menu-title">
                        確認
                    </div>
                    <div class="row justify-content-center menu-desc">
                        作ったクリップを見る
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row gap-5">
                <div class="flex-fill menu-item" @click="goToLogin()">
                    <div class="row justify-content-center">
                        <div class="menu-icon">
                            <img src="../../images/kari01.png" width="80" />
                        </div>
                    </div>
                    <div class="row justify-content-center menu-title">X</div>
                    <div class="row justify-content-center menu-desc">
                        ログイン
                    </div>
                </div>
                <div class="flex-fill menu-item" @click="goToPage('/')">
                    <div class="row justify-content-center">
                        <div class="menu-icon">
                            <img src="../../images/kari01.png" width="80" />
                        </div>
                    </div>
                    <div class="row justify-content-center menu-title">
                        作成
                    </div>
                    <div class="row justify-content-center menu-desc">aaa</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Header from "@/components/Header.vue";

export default {
    components: {
        Header,
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
.area-clip {
    width: 100%;
    background-image: url("../../images/black_00014.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: bottom;
    background-attachment: fixed;
    border: #333 3px solid;
    border-left: transparent;
    border-right: transparent;
    padding: 3em 2em;
}

.menu-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 2em;
    justify-content: center;
}

.menu-item {
}

.menu-icon {
    border: 1px solid #fff;
    border-radius: 8px;
    background-color: #fff;
}

.menu-title {
    padding: 0.2em 0;
    font-size: 1em;
    color: #eee;
}

.menu-desc {
    font-size: 0.8em;
    color: #aaa;
}
</style>
