<template>
    <div>
        <div
            class="share-to-twitter d-flex gap-1 align-items-center justify-content-center w-50"
            @click="shareToTwitter"
        >
            <div class="">
                <img :src="ImageTwitter" alt="twitter" width="14" />
            </div>
            <div class="">このページを共有</div>
        </div>
    </div>
</template>

<script>
import ImageTwitter from "~images/logo-twitter-white.png";

export default {
    props: {
        text: {
            type: String,
            default: "",
        },
        url: {
            type: String,
            default: "",
        },
    },
    data() {
        return {
            ImageTwitter: ImageTwitter,
        };
    },
    methods: {
        shareToTwitter() {
            const url = `https://twitter.com/intent/tweet?text=${this.title}&url=${this.url}`;
            window.open(url, "_blank");
        },
    },
};
</script>

<style scoped>
.share-to-twitter {
    cursor: pointer;
    font-size: 0.8rem;
    background-color: black;
    border-radius: 0.8rem;
    padding: 0.5rem;
}
</style>
