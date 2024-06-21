<template>
  <div class="menu-container" ref="menuSection">
    <h1 class="title display-4">Cliptube</h1>
    <div class="menu-grid">
      <div class="menu-item" @click="scrollToSearchYoutubeChannel">
        クリップ作成
      </div>
      <div class="menu-item" @click="scrollToClipList">クリップ一覧</div>
      <div class="menu-item" @click="scrollToAbout">Cliptubeについて</div>
      <div class="menu-item" @click="openTwitter">X(旧Twitter)</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    scrollToSearchYoutubeChannel() {
      this.$emit("scrollToSearchYoutubeChannel");
    },
    scrollToClipList() {
      this.$emit("scrollToClipList");
    },
    scrollToAbout() {
      this.$emit("scrollToAbout");
    },
    openTwitter() {
      window.open("https://twitter.com/", "_blank");
    },
  },
};
</script>

<style scoped>
.menu-container {
  width: 100%;
  height: 100%;
  text-align: center;
  padding: 20px;
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
</style>
