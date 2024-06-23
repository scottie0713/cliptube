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
      <div>
        <h4>チェックポイント</h4>
        <div v-for:="checkPoint in checkpoints" :key="checkPointKey">
          <div>
            {{ checkPoint.sec }}&nbsp;{{ getTimeFormat(checkPoint.sec) }}
          </div>
          <div @click="deleteCheckPoint(checkPointKey)">×</div>
        </div>
      </div>
      <div>
        <h4>クリップ</h4>
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
          console.log("getCheckpoints", response);
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
    async deleteCheckPoint(key) {
      const checkpoint = this.checkpoints[key];
      console.log("Delete Checkpoint key:", key);
      console.log("Delete Checkpoint sec:", checkpoint);

      try {
        const response = await axios.delete("/api/checkpoint/" + key, {});
        if (response.status === 200) {
          console.log("deleteCheckPoint", response);
          this.getCheckpoints();
        }
      } catch (error) {
        console.error(error);
      }
    },
    setCheckpoints(checkpoints) {
      for (const checkpoint of checkpoints) {
        this.checkpoints.push(checkpoint);
      }
    },
    // クリップ
    async getClips() {
      try {
        const response = await axios.get("/api/clip/" + this.videoId, {});
        if (response.status === 200) {
          console.log("getClips", response);
          this.clips = response.data;
        }
      } catch (error) {
        console.error(error);
      }
    },
    setClips(clips) {
      for (const clip of clips) {
        this.checkpoints.push(clip);
      }
    },
    // その他
    getTimeFormat(seconds) {
      const minutes = Math.floor(seconds / 60);
      const remainingSeconds = Math.floor(seconds % 60);
      return `${minutes}:${
        remainingSeconds < 10 ? "0" : ""
      }${remainingSeconds}`;
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
</style>
