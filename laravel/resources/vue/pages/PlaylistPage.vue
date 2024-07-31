<template>
    <div>
        <Header :user="user" />
        <PlaylistTitle />

        <div class="page-container">
            <div
                class="page-create my-3 d-inline-flex rounded py-2 px-4 mx-2"
                @click="goToPage('/playlist/create')"
            >
                &#x2719;&nbsp;新規作成
            </div>
            <!-- 検索結果一覧 -->
            <div class="row">
                <div
                    v-for="playlist in playlists"
                    class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3"
                >
                    <PlaylistLists :playlist="playlist" />
                </div>
            </div>
            <!-- /検索結果一覧 -->
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { apiGet, apiPost } from "~js/utils/api.js";
import Header from "@/components/Header.vue";
import ImagePlus from "@/components/Images/Plus.vue";
import PlaylistTitle from "@/components/Playlist/ListTitle.vue";
import PlaylistLists from "@/components/Playlist/Lists.vue";

export default {
    components: {
        Header,
        ImagePlus,
        PlaylistTitle,
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
        };
    },
    created() {
        this.userHash = this.$route.params.hash;
        apiGet(
            `/api/playlist/user/${this.userHash}`,
            this.setPlaylists,
            () => {}
        );
    },
    methods: {
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
    },
};
</script>

<style scoped>
.page-container {
    width: 90%;
    margin: 0 auto;
}

.page-create {
    cursor: pointer;
    color: aliceblue;
    background-color: #4caf50;
}
</style>
