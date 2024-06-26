<template>
  <div
    class="edit-clip-container text-dark text-center"
    ref="searchYoutubeChannelSection"
  >
    <h2 class="my-2 fs-3">②クリップを作りましょう</h2>
    <div class="py-1">
      <div class="player">
        <YouTubePlayer :videoId="videoId" ref="YouTubePlayer" />
        <div class="player-control d-flex justify-content-center">
          <button @click="relativeSeekAndPlay(-30)" class="flex-fill btn">
            &lt;&nbsp;30秒
          </button>
          <div class="vr"></div>
          <button @click="relativeSeekAndPlay(-5)" class="flex-fill btn">
            &lt;&nbsp;5秒
          </button>
          <div class="vr"></div>
          <button @click="setNewClipStart" class="flex-fill btn">
            開始時間マーク
          </button>
          <div class="vr"></div>
          <button @click="setNewClipEnd" class="flex-fill btn">
            終了時間マーク
          </button>
          <div class="vr"></div>
          <button @click="relativeSeekAndPlay(5)" class="flex-fill btn">
            5秒&nbsp;&gt;
          </button>
          <div class="vr"></div>
          <button @click="relativeSeekAndPlay(30)" class="flex-fill btn">
            30秒&nbsp;&gt;
          </button>
        </div>
      </div>

      <div class="mt-4">
        <form @submit.prevent="addClip">
          <div class="d-flex form-group gap-1">
            <input
              type="text"
              v-model="newClip.title"
              id="title"
              placeholder="クリップタイトル"
            />
            <button
              class="btn btn-outline-dark"
              @click="seekAndPlay(newClip.start)"
            >
              {{ getTimeFormat(newClip.start) }}~
            </button>
            <button
              class="btn btn-outline-dark"
              @click="seekAndPlay(newClip.end)"
            >
              ~{{ getTimeFormat(newClip.end) }}
            </button>
            <button type="submit" class="btn btn-outline-success">追加</button>
          </div>
        </form>
      </div>
      <div class="mt-4">
        <h3>追加したクリップ一覧</h3>
        <ul class="clip-list">
          <li v-for="clip in clips" :key="clip.id" class="clip-item">
            <span>{{ clip.title }}</span>
            <span>
              {{ getTimeFormat(clip.start_sec) }}~{{
                getTimeFormat(clip.end_sec)
              }}
            </span>
            <button class="btn btn-outline-info" @click="copyToNewClip(clip)">
              コピー
            </button>
            <button class="btn btn-outline-danger" @click="deleteClip(clip.id)">
              削除
            </button>
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
      clips: [],
      newClip: {
        title: "",
        start: 0,
        end: 0,
      },
    };
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
  text-align: center;
  margin: 40px auto;
  padding: 20px;
  border-radius: 20px;
  color: rgb(10, 36, 59);
}

.player {
  position: relative;
}

.player-control {
  border: 1px solid #ccc;
  border-radius: 8px;
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
