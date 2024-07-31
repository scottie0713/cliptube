<template>
    <div class="playlist-form-container">
        <div class="form-group">
            <div class="">プレイリスト名</div>
            <input
                type="text"
                v-model="title"
                id="title"
                placeholder="プレイリスト名"
                class="form-control mb-3"
            />
            <div>説明文</div>
            <textarea
                v-model="description"
                id="description"
                placeholder="説明文"
                class="form-control mb-4"
            >
            </textarea>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseOne"
                            aria-expanded="true"
                            aria-controls="collapseOne"
                            @click="toggleCollapse1"
                        >
                            クリップ登録・解除
                        </button>
                    </h2>
                    <transition>
                        <div
                            id="collapseOne"
                            class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample"
                            v-if="isCollapse1"
                        >
                            <div class="accordion-body">
                                <strong
                                    >This is the first item's accordion
                                    body.</strong
                                >
                                It is shown by default, until the collapse
                                plugin adds the appropriate classes that we use
                                to style each element. These classes control the
                                overall appearance, as well as the showing and
                                hiding via CSS transitions. You can modify any
                                of this with custom CSS or overriding our
                                default variables. It's also worth noting that
                                just about any HTML can go within the
                                <code>.accordion-body</code>, though the
                                transition does limit overflow.
                            </div>
                        </div>
                    </transition>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo"
                            aria-expanded="false"
                            aria-controls="collapseTwo"
                        >
                            クリップ並べ替え
                        </button>
                    </h2>
                    <div
                        id="collapseTwo"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionExample"
                    >
                        <div class="accordion-body">
                            <strong
                                >This is the second item's accordion
                                body.</strong
                            >
                            It is hidden by default, until the collapse plugin
                            adds the appropriate classes that we use to style
                            each element. These classes control the overall
                            appearance, as well as the showing and hiding via
                            CSS transitions. You can modify any of this with
                            custom CSS or overriding our default variables. It's
                            also worth noting that just about any HTML can go
                            within the <code>.accordion-body</code>, though the
                            transition does limit overflow.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseThree"
                            aria-expanded="false"
                            aria-controls="collapseThree"
                        >
                            ３
                        </button>
                    </h2>
                    <div
                        id="collapseThree"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionExample"
                    >
                        <div class="accordion-body">
                            <strong
                                >This is the third item's accordion
                                body.</strong
                            >
                            It is hidden by default, until the collapse plugin
                            adds the appropriate classes that we use to style
                            each element. These classes control the overall
                            appearance, as well as the showing and hiding via
                            CSS transitions. You can modify any of this with
                            custom CSS or overriding our default variables. It's
                            also worth noting that just about any HTML can go
                            within the <code>.accordion-body</code>, though the
                            transition does limit overflow.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 d-flex gap-2 justify-content-center">
            <button @click="postClip" class="btn btn-success">保存</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { timeHelper } from "~js/helpers/timeHelper.js";
import { apiGet, apiPost } from "~js/utils/api.js";

export default {
    props: {
        playlistHash: {
            type: String,
            required: false,
        },
    },
    components: {},
    mixins: [timeHelper],
    data() {
        return {
            title: "",
            description: "",
            videosClips: [],
            isCollapse1: true,
            isCollapse2: false,
            isCollapse3: false,
        };
    },
    created() {
        if (this.playlistHash) {
            apiGet(
                `/api/playlist/${this.playlistHash}`,
                this.setPlaylist,
                () => {}
            );
        }
        apiGet("/api/video/list/my/all", this.setVideoClips, () => {});
    },
    mounted() {},
    methods: {
        toggleCollapse1() {
            this.isCollapse1 = !this.isCollapse1;
        },
        toggleCollapse2() {
            this.isCollapse2 = !this.isCollapse2;
        },
        toggleCollapse3() {
            this.isCollapse3 = !this.isCollapse3;
        },
        setPlaylist(data) {
            this.title = data.title;
            this.description = data.description;
            this.clips = data.clips;
        },
        setVideoClips(data) {
            this.videosClips = [];
            data.forEach((video) => {
                this.videosClips.push({
                    id: video.id,
                    title: video.title,
                    url: video.url,
                    thumbnail: video.thumbnail,
                    duration: video.duration,
                    isClip: false,
                });
            });
        },
        async save() {
            const data = {
                title: this.title,
                description: this.description,
                clips: this.clips,
            };
            apiPost(`/api/playlist`, data, this.saveCallback, () => {});
        },
        saveCallback() {
            // this.$emit("getClips");
        },
    },
};
</script>

<style scoped>
.playlist-form-container {
}

.current-time {
    font-size: 0.7em;
    line-height: 0.5em;
}

.btn-narrow {
    width: 2em;
}

input {
    width: 100%;
    height: 2em;
}
</style>
