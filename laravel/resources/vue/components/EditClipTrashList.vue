<template>
    <div class="edit-clip-form-container text-start">
        <p>ごみ箱の中身はある程度の日数後、自動的に削除されます</p>
        <ul class="list-group">
            <li v-for="clip in clips" :key="clip.id" class="list-group-item">
                <div class="d-flex flex-row">
                    <div class="d-flex flex-column flex-grow-1">
                        <span class="clip-title">{{ clip.title }}</span>
                        <span class="clip-time">
                            {{ timeFormat(clip.start_sec) }}~{{
                                timeFormat(clip.end_sec)
                            }}
                        </span>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";
import { timeHelper } from "~js/helpers/timeHelper.js";
export default {
    props: {
        videoId: {
            type: String,
            required: true,
        },
    },
    components: {},
    mixins: [timeHelper],
    data() {
        return {
            clips: [],
        };
    },
    created() {},
    mounted() {
        this.getClips();
    },
    methods: {
        setTrash(clip) {
            this.$emit("setForm", clip);
        },
        async getClips() {
            try {
                const response = await axios.get(
                    "/api/clip/" + this.videoId + "/trash",
                    {}
                );
                if (response.status === 200) {
                    this.setClips(response.data);
                }
            } catch (error) {
                console.error(error);
            }
        },
        setClips(userClips) {
            this.clips = [];
            for (const userClip of userClips) {
                this.clips.push(userClip.clip);
            }
        },
    },
};
</script>

<style scoped>
.clip-title {
    font-size: 1em;
}

.clip-time {
    font-size: 0.8em;
    color: #aaa;
}
</style>
