<template>
  <div class="container" ref="menuSection">
    <h1 class="title display-4">Cliptube</h1>
    <div class="menu-grid">
      <div class="menu-item" @click="switchTo('CreateClip')">クリップ作成</div>
      <div class="menu-item" @click="switchTo('ClipList')">クリップ一覧</div>
      <div class="menu-item" @click="switchTo('About')">Cliptubeについて</div>
      <div class="menu-item" @click="switchTo('openTwitter')">X(旧Twitter)</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  mounted() {
    this.$emit("closeLoading");
  },
  methods: {
    switchTo(component) {
      this.$emit("switchTo", component);
    },
  },
};
</script>

<style scoped>
.container {
  width: 100%;
  height: 100%;
  text-align: center;
  padding: 20px;
}

.title {
  font-size: 5em;
  margin-bottom: 50px;
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
