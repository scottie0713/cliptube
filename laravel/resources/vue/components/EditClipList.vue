<template>
    <div class="edit-clip-list-container text-start">
        <div class="my-2">
            <button class="btn btn-light btn-sm" @click="getClips()">
                更新
            </button>
        </div>
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
                    <div class="d-flex flex-row gap-1 justify-content-between">
                        <button class="btn btn-light" @click="setForm(clip)">
                            <Edit :width="'20px'" :height="'20px'" />
                        </button>
                        <button
                            class="btn btn-light"
                            @click="disableClip(clip.id)"
                        >
                            <TrashBox :width="'20px'" :height="'20px'" />
                        </button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";
import { apiGet, apiPost } from "~js/utils/api.js";
import { timeHelper } from "~js/helpers/timeHelper.js";
import TrashBox from "@/components/Parts/TrashBox.vue";
import Edit from "@/components/Parts/Edit.vue";
export default {
    props: {
        videoId: {
            type: String,
            required: true,
        },
    },
    components: {
        TrashBox,
        Edit,
    },
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
        setForm(clip) {
            this.$emit("setForm", clip);
        },
        setClips(clips) {
            console.log(clips);
            this.clips = [];
            for (const clip of clips) {
                this.clips.push(clip);
            }
        },
        async getClips() {
            apiGet("/api/clip/" + this.videoId + "/my", this.setClips, this.errorClips);
        },
        async disableClip(clipId) {
            console.log("disableClip", this.newClip);
            try {
                const response = await axios.put("/api/user-clip/" + clipId, {
                    enabled: false,
                });
                if (response.status === 200) {
                    this.getClips();
                }
            } catch (error) {
                console.error(error);
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
