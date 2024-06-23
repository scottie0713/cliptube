<template>
  <div class="container" ref="searchYoutubeChannelSection">
    <h2 class="title">Clip編集</h2>
    <div></div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      movieId: "",
    };
  },
  mounted() {
    this.getMovie();
  },
  methods: {
    async getMovie() {
      try {
        const response = await axios.get("/api/get-movie", {
          params: {
            id: this.movieId,
          },
        });
        if (response.status === 200) {
          console.log(response);
        }
      } catch (error) {
        console.error(error);
      }
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
