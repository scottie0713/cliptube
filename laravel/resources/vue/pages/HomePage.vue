<template>
  <div class="page-container text-center text-light">
    <h1 class="title display-4">つべくりっぷ</h1>
    <div>
      Youtubeのクリップ機能が個人的に面倒なので作りました。
      お気に入りシーンを見返すことが多い人へ。
    </div>
    <h3>できること</h3>
    <div>
      <ul>
        <li>動画にクリップを連続で作成</li>
        <li>クリップした動画を組み合わせて連続で再生</li>
        <li></li>
      </ul>
    </div>
    <h3>注意事項</h3>
    <ul>
      <li>Youtubeが提供する機能の無料分でできる範囲でのご利用となります。</li>
      <li>Youtube外部プレイヤーを使用しています。クリップ作成時に広告が流れる場合があります。</li>
    </ul>
    <div class="menu-grid text-wrap">
      <div class="menu-item" @click="goToPage('/video/search')">
        <div class="fs-3">クリップを作る</div>
        <p class="fs-6 text-body-tertiary">
          YouTube動画から好きなところを保存します
        </p>
      </div>
      <div class="menu-item" @click="goToPage('/user/' + userHash)">
        <div class="fs-3">マイページ</div>
        <p class="fs-6 text-body-tertiary">保存したクリップなどを確認します</p>
      </div>
      <div class="menu-item" @click="goToPage('About')">
        <div class="fs-3">このサイトって？</div>
        <p class="fs-6 text-body-tertiary">つべくりっぷ&nbsp;についての説明です</p>
      </div>
      <div class="menu-item" @click="goToPage('openTwitter')">
        <div class="fs-3">X(旧Twitter)</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["userHash"],
  data() {
    return {};
  },
  mounted() {
    console.log("userHash", this.userHash);
  },
  methods: {
    goToPage(path) {
      this.$router.push(path);
    }
  },
};
</script>

<style scoped>
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
