<template>
    <div
        :class="[
            'menu-box d-flex justify-content-center align-items-center gap-2 word-break',
            { monochrome: !isEnable },
            { clickable: isEnable },
        ]"
        :style="{ backgroundColor: backgroundColor }"
        @click="isEnable ? goToPage(linkPath) : null"
    >
        <div v-if="imageName == 'ImageClip'" class="menu-icon">
            <ImageClip size="36" />
        </div>
        <div v-else-if="imageName == 'ImageSearchOrange'" class="menu-icon">
            <ImageSearchOrange size="36" />
        </div>
        <div v-else-if="imageName == 'ImageScissors'" class="menu-icon">
            <ImageScissors size="36" />
        </div>
        <div v-else-if="imageName == 'ImageVideoStory'" class="menu-icon">
            <ImageVideoStory size="36" />
        </div>
        <div class="menu-desc flex-fill">
            {{ menuTitle }}
        </div>
    </div>
</template>

<script>
import { markRaw } from "vue";
import ImageScissors from "@/components/Images/Scissors.vue";
import ImageVideoStory from "@/components/Images/VideoStory.vue";
import ImageClip from "@/components/Images/Clip.vue";
// import ImageSearch from "@/components/Images/Search.vue";
import ImageSearchOrange from "@/components/Images/SearchOrange.vue";
export default {
    props: {
        imageName: {
            type: String,
            required: true,
        },
        isEnable: {
            type: Boolean,
            default: true,
        },
        menuTitle: {
            type: String,
            required: true,
        },
        backgroundColor: {
            type: String,
            required: true,
        },
        linkPath: {
            type: String,
            required: true,
        },
    },
    components: {
        ImageClip,
        // ImageSearch,
        ImageSearchOrange,
        ImageScissors,
        ImageVideoStory,
    },
    methods: {
        goToPage(path) {
            this.$router.push(path);
        },
    },
};
</script>

<style scoped>
.menu-box {
    margin: 1rem 0;
    border-radius: 0.5rem;
    padding: 1.4rem;
    color: #fff;
    font-size: 1.2rem;
}

.menu-icon {
    margin: 0.2rem 0;
}

.menu-desc {
    font-size: 1rem;
    color: #fff;
    text-align: left;
}

.monochrome {
    filter: grayscale(100%);
}

.clickable {
    cursor: pointer;
}
</style>
