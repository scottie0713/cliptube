<template>
  <div
    class="edit-clip-form-container text-center"
  >
      <div class="mt-4">
        <form @submit.prevent="addClip">
          <div class="d-flex form-group gap-1">
            <input
              type="text"
              v-model="newClip.title"
              id="title"
              placeholder="メモ"
            />
            <button
              class="btn btn-outline-light"
              @click="seekAndPlay(newClip.start)"
            >
              {{ getTimeFormat(newClip.start) }}~
            </button>
            <button
              class="btn btn-outline-light"
              @click="seekAndPlay(newClip.end)"
            >
              ~{{ getTimeFormat(newClip.end) }}
            </button>
            <button type="submit" class="btn btn-outline-success">追加</button>
          </div>
        </form>
      </div>
  </div>
</template>

<script>
export default {
  props: {
  },
  components: {
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
  created() {
  },
  mounted() {
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
    // その他
    getTimeFormat(seconds) {
      return this.$emit("getTimeFormat", seconds)
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
