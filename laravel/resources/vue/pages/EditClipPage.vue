<template>
  <div
    class="edit-clip-container text-center"
  >
    <h2 class="fs-3">クリップ編集</h2>
    <YouTubePlayer :videoId="videoId" ref="YouTubePlayer" />
    <EditClipController @pause="pause" @play="play" @getTimeFormat="getTimeFormat" />
    <EditClipForm @addClip="addClip" @setNewClipStart="setNewClipStart" @setNewClipEnd="setNewClipEnd" @getTimeFormat="getTimeFormat" />
    <!-- 2つのタブつきメニュー -->
    <div class="tab-box">
      <ul class="tab-menu">
        <li :class="{ active: activeTab === 1 }" @click="activeTab = 1">クリップ一覧</li>
        <li :class="{ active: activeTab === 2 }" @click="activeTab = 2">ごみ箱</li>
      </ul>
      <div class="tab-content">
        <EditClipList @getTimeFormat="getTimeFormat" v-show="activeTab === 1" />
        <EditClipTrashList @getTimeFormat="getTimeFormat" v-show="activeTab === 2" />
      </div>
    </div>

    
  </div>
</template>

<script>
import axios from "axios";
import EditClipController from "@/components/EditClipController.vue";
import EditClipForm from "@/components/EditClipForm.vue";
import EditClipList from "@/components/EditClipList.vue";
import EditClipTrashList from "@/components/EditClipTrashList.vue";
import YouTubePlayer from "@/components/YouTubePlayer.vue";

export default {
  props: {
  },
  components: {
    YouTubePlayer,
    EditClipController,
    EditClipForm,
    EditClipList,
    EditClipTrashList,
  },
  data() {
    return {
      videoId: null,
      activeTab: 1,
      clips: [],
      newClip: {
        title: "",
        start: 0,
        end: 0,
      },
    };
  },
  created() {
    this.videoId = this.$route.params.hash
  },
  mounted() {
    this.getClips();
  },
  methods: {
    copyToNewClip(clip) {
      this.newClip.title = clip.title;
      this.newClip.start = clip.start_sec;
      this.newClip.end = clip.end_sec;
    },
    setNewClipStart() {
      this.newClip.start = Math.floor(
        this.$refs.YouTubePlayer.getCurrentTime()
      );
    },
    setNewClipEnd() {
      this.newClip.end = Math.floor(this.$refs.YouTubePlayer.getCurrentTime());
    },
    // クリップ
    async getClips() {
      try {
        const response = await axios.get("/api/clip/" + this.videoId, {});
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
    async addClip() {
      console.log("addClip", this.newClip);
      try {
        const response = await axios.post("/api/clip", {
          video_id: this.videoId,
          start_sec: this.newClip.start,
          end_sec: this.newClip.end,
          title: this.newClip.title,
        });
        if (response.status === 200) {
          console.log("addClip", response);
          this.getClips();
        }
      } catch (error) {
        console.error(error);
      }
    },
    async deleteClip(id) {
      try {
        const response = await axios.delete("/api/clip/" + id, {});
        if (response.status === 200) {
          this.getClips();
        }
      } catch (error) {
        console.error(error);
      }
    },
    // その他
    getTimeFormat(seconds) {
      if (seconds === 0) {
        return "0:00";
      }
      const hours = Math.floor(seconds / 3600);
      const minutes = Math.floor((seconds % 3600) / 60);
      const remainingSeconds = Math.floor(seconds % 60);

      return `${hours > 0 ? `${hours}:` : ""}${
        minutes < 10 && hours > 0 ? "0" : ""
      }${minutes}:${remainingSeconds < 10 ? "0" : ""}${remainingSeconds}`;
    },
    pause() {
      this.$refs.YouTubePlayer.pause();
    },
    play() {
      console.log("PLAY");
      this.$refs.YouTubePlayer.play();
    },
    seekAndPlay(sec) {
      this.$refs.YouTubePlayer.seekAndPlay(sec);
    },
    relativeSeekAndPlay(sec) {
      this.$refs.YouTubePlayer.relativeSeekAndPlay(sec);
    },
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
  border: 1px solid #ccc;
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
}

.tab-content {
  padding: 10px;
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
