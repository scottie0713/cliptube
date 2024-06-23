<template>
  <div class="edit-clip-container" ref="searchYoutubeChannelSection">
    <h2 class="text-light">Clip編集</h2>
    <div class="py-4">
      <div class="player">
        <YouTubePlayer :videoId="videoId" ref="YouTubePlayer" />
        <button @click="addCheckPoint" class="btn btn-outline-light">
          チェック
        </button>
      </div>

      <hr />

      <div class="checkpoints-container">
        <h4 class="text-light">チェックポイント</h4>
        <div class="checkpoints-container-item">
          <div
            v-for:="checkpoint in checkpoints"
            :key="checkpoint.id"
            class="checkpoint-box"
          >
            <span @click="seekAndPlay(checkpoint.sec)">{{
              getTimeFormat(checkpoint.sec)
            }}</span>
            <button
              @click="deleteCheckpoint(checkpoint.id)"
              class="delete-button"
            >
              ×
            </button>
          </div>
        </div>
      </div>

      <hr />

      <div class="clips-container">
        <h4>クリップ管理</h4>

        <form @submit.prevent="addClip">
          <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" v-model="newClip.title" id="title" required />
          </div>
          <div class="form-group">
            <label for="start-time">開始時間</label>
            <select v-model="newClip.start" id="start-time" required>
              <option
                v-for="checkpoint in checkpoints"
                :key="checkpoint.id"
                :value="checkpoint.sec"
              >
                {{ getTimeFormat(checkpoint.sec) }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <label for="end-time">終了時間</label>
            <select v-model="newClip.end" id="end-time" required>
              <option
                v-for="checkpoint in checkpoints"
                :key="checkpoint.id"
                :value="checkpoint.sec"
              >
                {{ getTimeFormat(checkpoint.sec) }}
              </option>
            </select>
          </div>
          <button type="submit">追加</button>
        </form>

        <h3>クリップリスト</h3>
        <ul class="clip-list">
          <li v-for="clip in clips" :key="clip.id" class="clip-item">
            <span>{{ clip.title }}</span>
            <span
              >{{ getTimeFormat(clip.start_sec) }} ～
              {{ getTimeFormat(clip.end_sec) }}</span
            >
            <button @click="deleteClip(clip.id)">×</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import YouTubePlayer from "@/components/CreateClip/YouTubePlayer.vue";

export default {
  props: {
    videoId: {
      type: String,
      required: true,
    },
  },
  components: {
    YouTubePlayer,
  },
  data() {
    return {
      checkpoints: [],
      clips: [],
      newClip: {
        title: "",
        start: "",
        end: "",
      },
    };
  },
  mounted() {
    this.getCheckpoints();
  },
  methods: {
    // チェックポイント
    async getCheckpoints() {
      try {
        const response = await axios.get("/api/checkpoint/" + this.videoId, {});
        if (response.status === 200) {
          this.setCheckpoints(response.data);
        }
      } catch (error) {
        console.error(error);
      }
    },
    async addCheckPoint() {
      const currentTime = Math.floor(this.$refs.YouTubePlayer.getCurrentTime());
      console.log("Current Time:", currentTime);

      try {
        const response = await axios.post("/api/checkpoint", {
          video_id: this.videoId,
          sec: currentTime,
        });
        if (response.status === 200) {
          console.log("addCheckPoint", response);
          this.getCheckpoints();
        }
      } catch (error) {
        console.error(error);
      }
    },
    async deleteCheckpoint(id) {
      try {
        const response = await axios.delete("/api/checkpoint/" + id, {});
        if (response.status === 200) {
          console.log("deleteCheckPoint", response);
          this.getCheckpoints();
        }
      } catch (error) {
        console.error(error);
      }
    },
    setCheckpoints(checkpoints) {
      this.checkpoints = [];
      for (const checkpoint of checkpoints) {
        this.checkpoints.push(checkpoint);
      }
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
    setClips(clips) {
      this.clips = [];
      for (const clip of clips) {
        this.clips.push(clip);
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
      const hours = Math.floor(seconds / 3600);
      const minutes = Math.floor((seconds % 3600) / 60);
      const remainingSeconds = Math.floor(seconds % 60);

      return `${hours > 0 ? `${hours}:` : ""}${
        minutes < 10 && hours > 0 ? "0" : ""
      }${minutes}:${remainingSeconds < 10 ? "0" : ""}${remainingSeconds}`;
    },
    seekAndPlay(sec) {
      this.$refs.YouTubePlayer.seekAndPlay(sec);
    },
  },
};
</script>

<style scoped>
.edit-clip-container {
  text-align: center;
  margin: 40px auto;
  padding: 20px;
  border-radius: 20px;
  color: rgb(10, 36, 59);
}

.player {
  position: relative;
}
.player button {
  position: absolute;
  bottom: 100px;
  left: 10px;
  background-color: #136600;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 10px;
  cursor: pointer;
}

.checkpoints-container-item {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.checkpoint-box {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px;
  border-radius: 12px;
  background-color: #f5f5f5;
  border: 1px solid #147700;
  width: 120px;
  position: relative;
}

.checkpoint-box span {
  font-size: 14px;
  background-color: #f5f5f5;
  color: #147700;
  border-left: 1px solid #ccc;
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

form {
  display: flex;
  flex-direction: column;
}

.form-group {
  margin-bottom: 10px;
}

.form-group label {
  margin-bottom: 5px;
}

.form-group input,
.form-group select {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button[type="submit"] {
  padding: 10px;
  border: none;
  border-radius: 4px;
  background-color: #bbdcff;
  color: white;
  cursor: pointer;
  font-size: 16px;
}

button[type="submit"]:hover {
  background-color: #465669;
}

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
