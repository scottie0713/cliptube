<template>
  <div class="container">
    <h2 class="title">動画検索</h2>
    <div>
      <!-- 動画検索フォーム -->
      <form @submit.prevent="searchMovie" class="">
        <input
          type="text"
          v-model="query"
          placeholder="検索ワードを入力してください"
          class="form-control w-75"
        />
        <button type="submit" class="btn btn-outline-light">検索</button>
      </form>
      <!-- /動画検索フォーム -->

      <!-- 検索結果一覧 -->
      <div class="mt-4">
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
            <div class="video-info text-start text-wrap">
              <h3 class="text-light fs-5">{{ video.snippet.title }}</h3>
              <p class="text-light fs-6">
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
form {
  display: flex;
  justify-content: center;
  gap: 1rem;
}

.container {
  text-align: center;
  margin: 10px auto;
  padding: 20px;
  color: aliceblue;
}

.video-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  transition: transform 0.3s, background-color 0.3s;
}

.video-item:hover {
  background-color: rgb(64, 64, 64);
}

.thumbnail {
  width: 120px;
  height: auto;
  border-radius: 8px;
}
</style>
