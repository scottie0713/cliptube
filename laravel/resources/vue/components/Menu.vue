<template>
  <div class="menu-container">
    <h1 class="title">Cliptube</h1>
    <div class="menu-grid">
      <div
        v-for="item in menuItems"
        :key="item.code"
        class="menu-item"
        @click="handleClick(item.code)"
      >
        {{ item.name }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      menuItems: [
        {
          code: "create",
          name: "クリップ作成",
        },
        {
          code: "list",
          name: "クリップ一覧",
        },
        {
          code: "about",
          name: "Cliptubeについて",
        },
        {
          code: "twitter",
          name: "X(旧Twitter)",
        },
      ],
    };
  },
  methods: {
    handleClick(code) {
      alert(`You clicked on ${code}`);
      // ここにクリック時の処理を追加できます
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
</style>
