<template>
    <div class="d-flex flex-row box text-start">
        <div class="bg-light text-dark p-2" style="font-size: 4rem">
            {{ number }}
        </div>
        <div class="p-2">
            <div>
                <div class="d-flex flex-column">
                    <div style="font-size: 1rem">{{ title }}</div>
                    <div style="font-size: 0.8rem">{{ desc }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ImageScissors from "@/components/Images/Scissors.vue";
// import ImageVideoStory from "@/components/Images/VideoStory.vue";
import ImageClip from "@/components/Images/Clip.vue";
// import ImageSearch from "@/components/Images/Search.vue";
import ImageSearchOrange from "@/components/Images/SearchOrange.vue";
export default {
    props: {
        number: {
            type: String,
            required: true,
        },
        title: {
            type: String,
            required: true,
        },
        desc: {
            type: String,
            required: true,
        },
    },
};
</script>

<style scoped>
.box {
    margin: 1rem 0;
    border-radius: 0.5rem;
    border: 0.1rem solid #fff;
    /* padding: 1.4rem; */
    /* font-size: 0.8rem; */
}
</style>
