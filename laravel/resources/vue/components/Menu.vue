<template>
  <div class="container text-center">
    <h1 class="title display-4">つべくりっぷ</h1>
    <div class="menu-grid text-wrap">
      <div class="menu-item" @click="switchTo('CreateClip')">
        <div class="fs-3">クリップ作成</div>
        <p class="fs-6 text-body-tertiary">
          YouTube動画から好きなところを保存します
        </p>
      </div>
      <div class="menu-item" @click="switchTo('ClipList')">
        <div class="fs-3">クリップ一覧</div>
        <p class="fs-6 text-body-tertiary">保存したクリップを確認します</p>
      </div>
      <div class="menu-item" @click="switchTo('About')">
        <div class="fs-3">このサイトって？</div>
        <p class="fs-6 text-body-tertiary">つべくりっぷ&nbsp;についての説明です</p>
      </div>
      <div class="menu-item" @click="switchTo('openTwitter')">
        <div class="fs-3">X(旧Twitter)</div>
      </div>
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
  text-align: center;
}

.title {
  font-size: 5em;
  margin-bottom: 50px;
}

.menu-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 2em;
  justify-content: center;
}

.menu-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 2em;
  border: 2px solid #ccc;
  border-radius: 2em;
  cursor: pointer;
  width: 240px;
  text-align: center;
  transition: transform 0.3s, background-color 0.3s;
}

.menu-item:hover {
  background-color: #fdffc6;
  transform: scale(1.05);
}
</style>
