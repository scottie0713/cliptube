<template>
  <div class="container">
    <h2 class="title">動画検索</h2>
    <div>
      <!-- 動画検索フォーム -->
      <form @submit.prevent="searchMovie" class="">
        <input
          type="text"
          v-model="query"
          placeholder="動画名を入力"
          class="form-control w-50"
        />
        <button type="submit" class="btn btn-outline-light">検索</button>
      </form>
      <!-- /動画検索フォーム -->

      <!-- 検索結果一覧 -->
      <div class="search-results">
        <div v-if="videos.length === 0">検索結果がありません。</div>
        <div v-else>
          <div
            v-for="video in videos"
            :key="video.id"
            class="video-item p-2 m-1"
            @click="setMovie(video.id.videoId)"
          >
            <img
              :src="video.snippet.thumbnails.default.url"
              :alt="video.snippet.title"
              class="thumbnail"
            />
            <div class="video-info text-start">
              <h3 class="video-title text-dark">{{ video.snippet.title }}</h3>
              <p class="video-publish-time text-dark">
                {{ formatDate(video.snippet.publishTime) }}
              </p>
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
.container {
  text-align: center;
  margin: 40px auto;
  padding: 20px;
  color: aliceblue;
}

.youtube-search-results {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.video-item {
  display: flex;
  align-items: flex-start;
  background-color: rgba(255, 255, 255, 0.5);
  gap: 1rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  transition: transform 0.3s, background-color 0.3s;
}

.video-item:hover {
  background-color: #ffffff;
  transform: scale(1.02);
}

.thumbnail {
  width: 120px;
  height: auto;
  border-radius: 4px;
}

.video-info {
  flex: 1;
}

.video-title {
  font-size: 1.2rem;
  margin: 0;
}

.video-publish-time {
  font-size: 0.9rem;
  color: #d6d6d6;
}
</style>
