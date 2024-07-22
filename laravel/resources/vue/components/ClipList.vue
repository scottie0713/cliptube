<template>
    <div class="row">
        <div v-for="c in clips" :key="c.id" class="col-auto mb-1">
            <div
                class="box-item"
                :class="[c.id == selectedClipId ? 'active' : 'inactive', '']"
                @click="clickClip(c)"
            >
                <div>{{ timeFormat(c.start_sec) }}&nbsp;{{ c.title }}</div>
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
    mounted() {},
    methods: {
        clickClip(clip) {
            this.selectedClipId = clip.id;
            this.$emit("playClip", clip.start_sec, clip.end_sec);
        },
    },
};
</script>

<style scoped>
.row {
    padding: 0.5rem;
}

.box-item {
    border-radius: 0.8rem;
    font-size: 0.7rem;
    font-weight: bold;
    color: #333;
    padding: 0.2rem 0.8rem;
    margin: 0.1rem 0;
    text-align: left;
    cursor: pointer;
}

.box-item.active {
    background-color: #fff;
    border: 2px solid #fff;
}

.box-item.inactive {
    background-color: #e0e0d1;
    border: 2px solid #e0e0d1;
}
</style>
