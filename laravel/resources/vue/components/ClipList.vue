<template>
    <div class="scroll-box" :style="{ height: height + 'px' }">
        <div
            v-for="c in clips"
            :key="c.id"
            class="d-flex flex-row justify-content-start align-items-center gap-2"
            @click="clickClip(c)"
        >
            <div class="card">
                <div class="inner">
                    <div>
                        {{ timeFormat(c.start_sec) }}~{{
                            timeFormat(c.end_sec)
                        }}
                    </div>
                    <div class="flex-fill justify-content-end">
                        {{ c.title }}
                    </div>
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
        return {};
    },
    mounted() {},
    methods: {
        clickClip(clip) {
            this.$emit("clickClip", clip);
        },
    },
};
</script>

<style scoped>
.scroll-box {
    border: 1px solid #666;
    overflow-y: auto;
}

.scroll-box-item {
    color: #333;
    background-color: #f0f0f0;
    border: 1px solid #bbb;
    font-size: 1rem;
    padding: 0.5rem;
    margin: 0.2rem 0;
    cursor: pointer;
}

.card {
    position: relative;
    border-radius: var(--border-radius);
    padding: 4px;
}

.card .inner {
    border-radius: 4px;
}

.card::before,
.card::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background: linear-gradient(
        45deg,
        #ff595e,
        #ffca3a,
        #8ac926,
        #1982c4,
        #6a4c93,
        #ff6700
    );
    background-size: 400%;
    z-index: -1;
    animation: glow 20s linear infinite;
    width: 100%;
    border-radius: var(--border-radius);
}

.card::after {
    filter: blur(25px);
    transform: translate3d(0, 0, 0); /* For Safari */
}

@keyframes glow {
    0% {
        background-position: 0 0;
    }

    50% {
        background-position: 100% 0;
    }

    100% {
        background-position: 0 0;
    }
}
</style>
