<template>
    <div class="page-title d-flex justify-content-center align-items-center">
        <div>
            <ImageSearch size="30" />
        </div>
        <div>YouTubeから動画を検索して編集開始</div>
    </div>
</template>

<script>
import ImageSearch from "@/components/Images/Search.vue";
export default {
    components: {
        ImageSearch,
    },
};
</script>

<style scoped>
.page-title {
    background-color: #c75c5c;
    margin: 0 auto 0 auto;
    padding: 0.2em;
    width: 100%;
}
</style>
