<template>
    <div>
        <Header />

        <div class="page-container">
            <!-- タイトル -->
            <div
                class="page-title d-flex justify-content-center align-items-center"
            >
                <div>
                    <ImageScissors size="30" />
                </div>
                <div>クリップ編集</div>
            </div>
            <!-- /タイトル -->
            <EditClipForm
                :videoId="videoId"
                @get-clips="getClips"
                ref="EditClipForm"
            />
            <!-- 2つのタブつきメニュー -->
            <div class="tab-box">
                <ul class="tab-menu">
                    <li
                        :class="{ active: activeTab === 1 }"
                        @click="activeTab = 1"
                    >
                        クリップ一覧
                    </li>
                    <li
                        :class="{ active: activeTab === 2 }"
                        @click="activeTab = 2"
                    >
                        ごみ箱
                    </li>
                </ul>
                <div class="tab-content">
                    <EditClipList
                        v-if="activeTab === 1"
                        :videoId="videoId"
                        @setForm="setForm"
                        ref="EditClipList"
                    />
                    <EditClipTrashList
                        v-if="activeTab === 2"
                        :videoId="videoId"
                        ref="EditClipTrashList"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "@/components/Header.vue";
import EditClipForm from "@/components/EditClipForm.vue";
import EditClipList from "@/components/EditClipList.vue";
import EditClipTrashList from "@/components/EditClipTrashList.vue";
import ImageScissors from "@/components/Images/Scissors.vue";

export default {
    props: {},
    components: {
        EditClipForm,
        EditClipList,
        EditClipTrashList,
        Header,
        ImageScissors,
    },
    data() {
        return {
            videoId: null,
            activeTab: 1,
        };
    },
    created() {
        this.videoId = this.$route.params.hash;
    },
    mounted() {
        // this.getClips();
    },
    methods: {
        setForm(clip) {
            this.$refs.EditClipForm.setForm(clip);
        },
        setTrash(clip) {
            this.$refs.EditClipTrashList.setTrash(clip);
        },
        setClips(userClips) {
            this.clips = [];
            for (const userClip of userClips) {
                this.clips.push(userClip.clip);
            }
        },
        // リストコンポーネント操作関数群
        getClips() {
            this.$refs.EditClipList.getClips();
        },
    },
};
</script>

<style scoped>
.page-container {
}

.page-title {
    background-color: #c75c5c;
    width: 90%;
    margin: 0 auto 2rem auto;
    padding: 0.2em;
    border-radius: 2em;
}

.player {
    position: relative;
}

.player-control {
    border: 1px solid #ccc;
    border-radius: 8px;
}

.tab-box {
    /* border: 1px solid #ccc; */
    margin: 20px 0;
    padding: 10px;
}

.tab-menu {
    list-style: none;
    padding: 0;
    display: flex;
    border-bottom: 1px solid #ccc;
    margin-bottom: 10px;
}

.tab-menu li {
    padding: 10px;
    cursor: pointer;
    border: 1px solid #ccc;
    border-bottom: none;
    margin-right: 5px;
}

.tab-menu li.active {
    background-color: #f0f0f0;
    font-weight: bold;
    color: #333;
}

.tab-content {
    /* padding: 10px; */
}

.delete-button {
    background: none;
    border: none;
    font-size: 16px;
    color: #147700;
    cursor: pointer;
    position: absolute;
    top: 5px;
    right: 5px;
}

.clips-container {
}

.form-group {
    margin-bottom: 10px;
}

.form-group input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* button[type="submit"] {
  padding: 10px;
  border: none;
  border-radius: 4px;
  background-color: #bbdcff;
  color: white;
  cursor: pointer;
  font-size: 16px;
} */

/* button[type="submit"]:hover {
  background-color: #465669;
} */

.clip-list {
    list-style-type: none;
    padding: 0;
}

.clip-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: white;
    margin-bottom: 10px;
}

.clip-item button {
    background: none;
    border: none;
    font-size: 16px;
    color: #f00;
    cursor: pointer;
}

.clip-item button:hover {
    color: #c00;
}
</style>
