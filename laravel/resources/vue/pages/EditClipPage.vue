<template>
    <div class="edit-clip-container text-center py-2">
        <br />
        <h2 class="fs-3">クリップ編集</h2>
        <EditClipForm
            :videoId="videoId"
            @add-clip="addClip"
            ref="EditClipForm"
        />
        <!-- 2つのタブつきメニュー -->
        <div class="tab-box">
            <ul class="tab-menu">
                <li :class="{ active: activeTab === 1 }" @click="activeTab = 1">
                    クリップ一覧
                </li>
                <li :class="{ active: activeTab === 2 }" @click="activeTab = 2">
                    ごみ箱
                </li>
            </ul>
            <div class="tab-content">
                <EditClipList
                    v-show="activeTab === 1"
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
</template>

<script>
import EditClipForm from "@/components/EditClipForm.vue";
import EditClipList from "@/components/EditClipList.vue";
import EditClipTrashList from "@/components/EditClipTrashList.vue";

export default {
    props: {},
    components: {
        EditClipForm,
        EditClipList,
        EditClipTrashList,
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
        async addClip(title, startSec, endSec) {
            this.$refs.EditClipList.addClip(title, startSec, endSec);
        },
        async trashClip(id) {},
    },
};
</script>

<style scoped>
.edit-clip-container {
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
