<template>
    <div class="wrapper d-flex flex-column align-items-center">
        <div
            v-for="c in clips"
            :key="c.id"
            class="mx-3 my-1 w-75"
            @click="clickClip(c)"
        >
            <div
                class="box-item"
                :class="[c.id == selectedClipId ? 'active' : 'inactive', '']"
            >
                <div>
                    {{ timeFormat(c.start_sec) }}~{{ timeFormat(c.end_sec) }}
                </div>
                <div>
                    {{ c.title }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { timeHelper } from "~js/helpers/timeHelper.js";

export default {
    props: {
        clips: {
            type: Array,
            default: [],
        },
        height: {
            type: Number,
            default: 400,
        },
    },
    mixins: [timeHelper],
    components: {},
    data() {
        return {
            selectedClipId: null,
        };
    },
    mounted() {
        // console.log(this.clips);
    },
    methods: {
        clickClip(clip) {
            this.selectedClipId = clip.id;
            this.$emit("playClip", clip.start_sec, clip.end_sec);
        },
    },
};
</script>

<style scoped>
.wrapper {
}

.box-item {
    font-size: 0.7rem;
    color: #333;
    border-radius: 0.4rem;
    padding: 0.4rem 0.8rem;
    margin: 0.1rem 0;
    text-align: left;
    cursor: pointer;
}

.box-item.active {
    background-color: #f5cf87;
    border: 2px solid #f5cf87;
}

.box-item.inactive {
    background-color: #e0e0d1;
    border: 2px solid #e0e0d1;
}
</style>
