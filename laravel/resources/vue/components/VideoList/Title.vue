<template>
    <div class="page-title d-flex justify-content-center align-items-center">
        <div>
            <ImageClip size="30" />
        </div>
        <div>あなたのクリップした動画一覧</div>
    </div>
</template>

<script>
import ImageClip from "@/components/Images/Clip.vue";
export default {
    components: {
        ImageClip,
    },
};
</script>

<style scoped>
.page-title {
    background-color: rgb(199, 185, 92);
    margin: 0 auto 2rem auto;
    padding: 0.2em;
    width: 100%;
}
</style>
