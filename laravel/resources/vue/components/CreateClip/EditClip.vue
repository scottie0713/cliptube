<template>
  <div class="container" ref="searchYoutubeChannelSection">
    <h2 class="title">Clip編集</h2>
    <div>
      <div>
        <YouTubePlayer :videoId="videoId" ref="YouTubePlayer" />
        <button @click="addCheckPoint" class="btn btn-outline-light">
          チェック
        </button>
      </div>

      <div class="checkpoints-container">
        <h4>チェックポイント</h4>
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
.container {
  text-align: center;
  margin: 40px auto;
  padding: 20px;
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 20px;
  color: rgb(10, 36, 59);
}

.menu-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
}

.menu-item {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #ededed;
  color: rgb(66, 66, 66);
  padding: 20px;
  border-radius: 8px;
  cursor: pointer;
  width: 120px;
  text-align: center;
  transition: transform 0.3s, background-color 0.3s;
}

.menu-item:hover {
  background-color: #ffff61;
  transform: scale(1.05);
}

.back-to-menu {
  position: absolute;
  top: -30px; /* Adjust as needed */
  left: 50%;
  transform: translateX(-50%);
  background-color: #007bff;
  color: white;
  padding: 10px;
  border-radius: 50%;
  cursor: pointer;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, background-color 0.3s;
}

.back-to-menu:hover {
  background-color: #0056b3;
  transform: scale(1.05);
}

.checkpoints-container {
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
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 12px;
  background-color: #f5f5f5;
  width: 400px;
  margin: 0 auto;
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
  background-color: #007bff;
  color: white;
  cursor: pointer;
  font-size: 16px;
}

button[type="submit"]:hover {
  background-color: #0056b3;
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
