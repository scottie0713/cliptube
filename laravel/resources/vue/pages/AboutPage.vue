<template>
  <div class="page-container w-100 h-100 text-wrap">
    <h2 class="my-2 fs-2">このサイトって？</h2>
    <div>
      <p>
        YouTubeの動画の好きなシーンの時間を保存して、それをまとめるツールです。
      </p>
      <p>あくまで時間を保存するだけなので動画を作成するわけではないです。</p>
      <p>
        YouTubeにはすでにクリップ機能がありますが、本家とは違い時間制限を気にしなくて良いし、複数動画のシーンをまとめることができます。
      </p>
      <p>
        例：動画Ａの00:10～00:30を再生してから動画Ｂの01:00～01:30を続けて見たい
      </p>
      <button class="btn btn-outline-dark w-50 my-4" @click="goToPage('Menu')">
        戻る
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  mounted() {
  },
  methods: {
    goToPage(path) {
      this.$router.push(path);
    }
  },
};
</script>

<style scoped>
.page-container {
  text-align: center;
}
.p {
  margin: 10px auto;
  padding: 20px;
}
</style>
