<template>
    <div :v-if="playlist">
        <div
            class="playlist-box d-flex justify-content-center align-items-center gap-2 word-break"
            @click="goToPage('/clip/' + playlist.hash)"
        >
            <div class="video-box-thumbnail"></div>
            <div class="flex-fill">
                {{ playlist.title }}
            </div>
        </div>
        <div
            class="btn btn-secondary"
            v-if="isEditable"
            @click="goToPage(`/playlist/${playlist.hash}/edit-title`)"
        >
            タイトル変更
        </div>
        <div
            class="btn btn-secondary"
            v-if="isEditable"
            @click="goToPage(`/playlist/${playlist.hash}/edit-clip`)"
        >
            クリップ編集
        </div>
        <div
            class="btn btn-secondary"
            v-if="isEditable"
            @click="deletePlaylist(playlist.hash)"
        >
            削除
        </div>
    </div>
</template>

<script>
import { apiDelete } from "~js/utils/api.js";
export default {
    props: {
        isEditable: {
            type: Boolean,
            required: true,
        },
        playlist: {
            type: Array,
            required: false,
        },
    },
    mounted() {
        console.log("isEditable", this.isEditable);
    },
    components: {},
    methods: {
        async deletePlaylist(playlistHash) {
            const data = {
                playlist_hash: playlistHash,
            };
            apiDelete(`/api/playlist`, data, this.successCallback, () => {});
        },
        successCallback() {
            this.$emit("reload");
        },
        goToPage(path) {
            this.$router.push(path);
        },
    },
};
</script>

<style scoped>
.playlist-box {
    margin: 0.4rem;
    background-color: #e0e0d1;
    border-radius: 0.8rem;
    padding: 0.8rem 1.2rem;
    font-size: 0.8rem;
    color: #333;
    cursor: pointer;
}
</style>
