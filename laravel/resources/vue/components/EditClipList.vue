<template>
  <div
    class="edit-clip-list-container text-center"
  >
    <div class="py-1">
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
</template>

<script>
export default {
  props: {
    videoId: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      clips: [],
    };
  },
  created() {
    this.getClips();
  },
  mounted() {
  },
  methods: {
    copyToNewClip(clip) {
      this.$emit("copyToNewClip", clip);
    },
    setClips(userClips) {
      this.clips = [];
      for (const userClip of userClips) {
        this.clips.push(userClip.clip);
      }
    },
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
      this.$emit("seekAndPlay", sec);
    },
  },
};
</script>

<style scoped>
.player-control {
  border: 1px solid #ccc;
  border-radius: 8px;
}

.form-group {
  margin-bottom: 10px;
}

.form-group input {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
</style>
