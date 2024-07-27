<template>
    <div class="page-title d-flex justify-content-center align-items-center">
        <div>
            <ImagePlay size="30" />
        </div>
        <div>あなたのプレイリスト</div>
    </div>
</template>

<script>
import ImagePlay from "@/components/Images/Play.vue";
export default {
    props: {
        title: {
            type: String,
            default: "",
        },
    },
    components: {
        ImagePlay,
    },
};
</script>

<style scoped>
.page-title {
    background-color: #76c2af;
    margin: 0 auto 0 auto;
    padding: 0.2em;
    width: 100%;
}
</style>
