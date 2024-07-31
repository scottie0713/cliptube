<template>
    <div>
        <Header :user="user" />
        <PlaylistTitle />
        <PlaylistForm />
    </div>
</template>

<script>
import axios from "axios";
import Header from "@/components/Header.vue";
import PlaylistForm from "@/components/Playlist/Form.vue";
import PlaylistTitle from "@/components/Playlist/CreateTitle.vue";

export default {
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    components: {
        Header,
        PlaylistForm,
        PlaylistTitle,
    },
    data() {
        return {
            playlistHash: null,
        };
    },
    created() {},
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
</style>
