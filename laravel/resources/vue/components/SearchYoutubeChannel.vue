<template>
  <div class="menu-container" ref="searchYoutubeChannelSection">
    <div class="back-to-menu" @click="scrollToMenu">
      &#9650; <!-- Up arrow symbol -->
    </div>
    <h2 class="title">チャンネル検索</h2>
    <div class="menu-grid">
      <form @submit.prevent="searchChannel">
        <input
          type="text"
          v-model="searchWord"
          placeholder="チャンネル名を入力"
          class="menu-item"
        />
        <button type="submit" class="menu-item">検索</button>
      </form>
      <div
        v-for="channel in channels"
        :key="channel.id"
        class="menu-item"
        @click="channelClick(channel.id)"
      >
        {{ channel.name }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      searchWord: "",
      channels: [],
    };
  },
  methods: {
    async searchChannel(code) {
      try {
        const response = await axios.get("/api/search-channel", {
          params: {
            searchWord: this.searchWord,
          },
        });
        if (response.status === 200) {
          console.log(response);
          this.channels = response.data;
        }
      } catch (error) {
        console.error(error);
      }
    },
    scrollToMenu() {
      this.$emit("scrollToMenu");
    },
  },
};
</script>

<style scoped>
.menu-container {
  text-align: center;
  margin: 40px auto;
  padding: 20px;
  color: aliceblue;
  background-color: rgba(40, 40, 40, 0.5);
  border-radius: 20px;
  width: 90%;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.title {
  font-size: 2em;
  margin-bottom: 20px;
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
