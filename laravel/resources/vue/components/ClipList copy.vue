<template>
  <div class="clip-list-container text-dark text-center" ref="YoutubeSection">
    <h2 class="my-2 fs-2">
      <button @click="switchTo('Menu')" class="text-dark">＜</button
      >&nbsp;クリップ一覧
    </h2>

    <div class="player" v-if="videoId">
      <YouTubePlayer :videoId="videoId" ref="YouTubePlayer" />
    </div>

    <div class="mt-4">
      <ul class="clip-list">
        <li v-for="clip in clips" :key="clip.id" class="clip-item">
          <span>{{ clip.title }}</span>
          <span>
            {{ getTimeFormat(clip.start_sec) }}~{{
              getTimeFormat(clip.end_sec)
            }}
          </span>
          <button class="btn btn-outline-info" @click="playClip(clip)">
            再生
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import YouTubePlayer from "@/components/CreateClip/YouTubePlayer.vue";

export default {
  props: {},
  components: {
    YouTubePlayer,
  },
  data() {
    return {
      videoId: "",
      clips: [],
    };
  },
  mounted() {
    this.getClips();
    this.$emit("closeLoading");
  },
  methods: {
    playClip(clip) {
      this.videoId = clip.video_id;
      this.$refs.YouTubePlayer.seekAndPlay(clip.start_sec);
    },
    // クリップ
    async getClips() {
      try {
        const response = await axios.get("/api/clip", {});
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
    switchTo(component) {
      this.$emit("switchTo", component);
    },
  },
};
</script>

<style scoped>
.clip-list-container {
  text-align: center;
  margin: 40px auto;
  padding: 20px;
  border-radius: 20px;
  color: rgb(10, 36, 59);
}

.player {
  position: relative;
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

h2 button {
  background: none;
  border: none;
  color: aliceblue;
  font-size: 1em;
  cursor: pointer;
}
</style>
