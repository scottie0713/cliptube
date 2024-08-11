<template>
    <div class="playlist-form-container">
        <div class="form-group">
            <div class="">プレイリスト名</div>
            <input
                type="text"
                v-model="title"
                id="title"
                placeholder="プレイリスト名"
                class="form-control mb-3"
            />
            <div>説明文</div>
            <textarea
                v-model="description"
                id="description"
                placeholder="説明文"
                class="form-control mb-4"
            >
            </textarea>
        </div>
        <div class="mt-3 d-flex gap-2 justify-content-center">
            <button @click="postPlaylist" class="btn btn-success">保存</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { apiGet, apiPost } from "~js/utils/api.js";

export default {
    props: {},
    components: {},
    data() {
        return {
            title: "",
            description: "",
        };
    },
    mounted() {},
    methods: {
        async postPlaylist() {
            const data = {
                title: this.title,
                description: this.description,
            };
            apiPost(`/api/playlist`, data, this.successCallback, () => {});
        },
        successCallback() {
            this.$emit("redirectToPlaylist");
        },
    },
};
</script>

<style scoped>
.playlist-form-container {
}

.current-time {
    font-size: 0.7em;
    line-height: 0.5em;
}

.btn-narrow {
    width: 2em;
}

input {
    width: 100%;
    height: 2em;
}
</style>
