<template>
    <div>
        <Header :user="user" />
        <div
            class="page-title d-flex justify-content-center align-items-center"
        >
            <div>
                <ImagePlay size="30" />
            </div>
            <div>あなたのプレイリスト</div>
        </div>

        <div class="page-container">
            <div
                class="page-create my-3 d-inline-flex rounded py-2 px-4 mx-2"
                @click="goToPage(`/playlist/create`)"
            >
                &#x2719;&nbsp;新規作成
            </div>
            <!-- 検索結果一覧 -->
            <div class="row">
                <div
                    v-for="playlist in playlists"
                    class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3"
                >
                    <PlaylistLists
                        :playlist="playlist"
                        :isEditable="isEditable"
                        @reload="reload"
                    />
                </div>
            </div>
            <!-- /検索結果一覧 -->
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { apiGet } from "~js/utils/api.js";
import Header from "@/components/Header.vue";
import ImagePlay from "@/components/Images/Play.vue";
import PlaylistLists from "@/components/Playlist/Lists.vue";

export default {
    components: {
        Header,
        ImagePlay,
        PlaylistLists,
    },
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            userHash: "",
            query: "",
            playlists: [],
            isEditable: false,
        };
    },
    created() {
        this.userHash = this.$route.params.hash;
        apiGet(
            `/api/playlist/user/${this.userHash}`,
            this.setPlaylists,
            () => {}
        );
        this.setEditable();
    },
    methods: {
        setEditable() {
            if (this.userHash === this.user.hash) {
                this.isEditable = true;
            }
        },
        setPlaylists(response) {
            this.playlists = [];
            for (const r of response) {
                this.playlists.push({
                    id: r.id,
                    title: r.title,
                    description: r.description,
                    hash: r.hash,
                });
            }
        },
        goToPage(path) {
            this.$router.push(path);
        },
        reload() {
            this.$router.go();
        },
    },
};
</script>

<style scoped>
.page-container {
    width: 90%;
    margin: 0 auto;
}

.page-create {
    background-color: #76c2af;
    cursor: pointer;
}

.page-title {
    background-color: #76c2af;
    margin: 0 auto 0 auto;
    padding: 0.2em;
    width: 100%;
}
</style>
