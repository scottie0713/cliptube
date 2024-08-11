<template>
    <div>
        <Header :user="user" />
        <div
            class="page-title d-flex justify-content-center align-items-center"
        >
            <div>
                <ImagePlay size="30" />
            </div>
            <div>プレイリスト作成</div>
        </div>
        <div class="p-4">
            <PlaylistTitleForm
                @redirectToPlaylist="goToPage(`/playlist/${userHash}`)"
            />
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Header from "@/components/Header.vue";
import PlaylistTitleForm from "@/components/Playlist/TitleForm.vue";
import ImagePlay from "@/components/Images/Play.vue";

export default {
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    components: {
        Header,
        PlaylistTitleForm,
        ImagePlay,
    },
    data() {
        return {
            userHash: "",
        };
    },
    created() {
        this.userHash = this.$route.params.hash;
    },
    methods: {
        goToPage(path) {
            this.$router.push(path);
        },
    },
};
</script>

<style scoped>
.page-container {
}

.page-title {
    background-color: #76c2af;
    margin: 0 auto 0 auto;
    padding: 0.2em;
    width: 100%;
}
</style>
