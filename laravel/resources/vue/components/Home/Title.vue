<template>
    <div class="px-4 py-5 text-center">
        <img :src="ImageTitle" width="240" />
    </div>
</template>

<script>
import ImageTitle from "~images/title.png";
export default {
    data() {
        return {
            ImageTitle: ImageTitle,
        };
    },
};
</script>

<style scoped></style>
