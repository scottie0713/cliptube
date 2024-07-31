<template>
    <div
        :v-if="playlist"
        class="playlist-box d-flex justify-content-center align-items-center gap-2 word-break"
        @click="goToPage('/clip/' + playlist.hash)"
    >
        <div class="video-box-thumbnail"></div>
        <div class="flex-fill">
            {{ playlist.title }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        playlist: {
            type: Array,
            required: false,
        },
    },
    components: {},
    methods: {
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
