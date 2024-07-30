<template>
    <div
        class="video-box d-flex justify-content-center align-items-center gap-2 word-break"
        @click="goToPage('/clip/' + video.id)"
    >
        <div class="video-box-thumbnail">
            <img
                :src="video.thumbnail"
                class="card-img-top"
                :alt="video.title"
                width="120"
            />
        </div>
        <div class="flex-fill">
            {{ video.title }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        video: {
            type: Array,
            required: true,
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
.video-box {
    margin: 0.4rem;
    background-color: #e0e0d1;
    border-radius: 0.8rem;
    padding: 0.8rem 1.2rem;
    font-size: 0.8rem;
    color: #333;
    cursor: pointer;
}
</style>
