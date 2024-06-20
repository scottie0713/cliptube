<template>
  <div>
    <!-- メインコンテンツ -->
    <div class="container mt-5 component-container">
      <div class="row">
        <div class="col text-center">
          <h1 class="display-4">Cliptube</h1>
          <p class="lead">
            あなたのお気に入りのシーンを簡単に保存して共有しましょう！
          </p>
          <div
            class="btn btn-outline-success me-2"
            @click="showComponent('register')"
          >
            新規登録
          </div>
          <button
            class="btn btn-outline-primary"
            @click="showComponent('login')"
          >
            ログイン
          </button>
        </div>
      </div>
    </div>

    <!-- 動的コンポーネント -->
    <div v-if="currentComponent">
      <component :is="currentComponent"></component>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      currentComponent: null,
    };
  },
  methods: {
    showComponent(componentName) {
      if (componentName === "register") {
        import("./Register.vue").then((module) => {
          this.currentComponent = module.default;
        });
      } else if (componentName === "login") {
        import("./Login.vue").then((module) => {
          this.currentComponent = module.default;
        });
      }
    },
  },
};
</script>

<style scoped>
/* ここにスタイルを追加 */
</style>
