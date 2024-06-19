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
        <PlaylistForm />
    </div>
</template>

<script>
import axios from "axios";
import Header from "@/components/Header.vue";
import PlaylistClipForm from "@/components/Playlist/ClipForm.vue";

export default {
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    components: {
        Header,
        PlaylistClipForm,
    },
    data() {
        return {
            playlistHash: null,
        };
    },
    created() {
        this.playlistHash = this.$route.params.hash;
    },
    mounted() {},
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
