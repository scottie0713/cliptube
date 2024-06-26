<template>
  <div class="video-search-container text-dark text-center">
    <h3 class="my-2 fs-3">①動画を探しましょう</h3>
    <div>
      <!-- 動画検索フォーム -->
      <form @submit.prevent="searchMovie" class="d-flex gap-3">
        <input
          type="text"
          v-model="query"
          placeholder="検索ワードを入力してください"
          class="form-control w-75"
        />
        <button type="submit" class="btn btn-outline-dark">検索</button>
      </form>
      <!-- /動画検索フォーム -->

      <!-- 検索結果一覧 -->
      <div class="video-search-result mt-4">
        <div v-if="videos.length === 0">検索結果がありません。</div>
        <div v-else>
          <div
            v-for="video in videos"
            :key="video.id"
            class="video-item py-1 px-2 m-1"
            @click="setMovie(video.id.videoId)"
          >
            <img
              :src="video.snippet.thumbnails.default.url"
              :alt="video.snippet.title"
              class="thumbnail"
            />
            <div
              class="text-start flex-column text-wrap align-items-center fs-6 text-dark"
            >
              <div>{{ video.snippet.title }}</div>
              <div>
                {{ formatDate(video.snippet.publishTime) }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /検索結果一覧 -->
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      query: "",
      videos: [],
    };
  },
  methods: {
    async searchMovie() {
      try {
        const response = await axios.get("/api/youtube/search", {
          params: {
            query: this.query,
          },
        });
        if (response.status === 200) {
          console.log(response.data);
          this.videos = response.data.items;
        }
      } catch (error) {
        console.error(error);
      }
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      return (
        date.getFullYear() + "/" + (date.getMonth() + 1) + "/" + date.getDate()
      );
    },
    setMovie(movieId) {
      this.$emit("setMovie", movieId);
    },
  },
};
</script>

<style scoped>
/* form {
  display: flex;
  justify-content: center;
  gap: 1rem;
} */

.video-search-result {
  border: 1px solid #ccc;
  border-radius: 1em;
  padding: 1em;
  color: gray;
}

.video-item {
  display: flex;
  align-items: center;
  border-radius: 1em;
  gap: 1rem;
  transition: transform 0.3s, background-color 0.3s;
}

.video-item:hover {
  background-color: rgb(219, 219, 219);
}

.thumbnail {
  width: 80px;
  height: auto;
  border-radius: 8px;
}
</style>
