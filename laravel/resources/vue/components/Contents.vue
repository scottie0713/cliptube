<template>
  <div class="contents-container">
    <Loading v-show="isLoadingSvg" />
    <Transition>
      <div v-show="isFade" class="loading"></div>
    </Transition>
    <component
      :is="currentComponent"
      @switch-to="switchTo"
      @close-loading="closeLoading"
    />
  </div>
</template>

<script>
import About from "@/components/About.vue";
import ClipList from "@/components/ClipList.vue";
import CreateClip from "@/components/CreateClip.vue";
import Loading from "@/components/Loading.vue";
import Menu from "@/components/Menu.vue";

export default {
  components: {
    About,
    ClipList,
    CreateClip,
    Loading,
    Menu,
  },
  data() {
    return {
      isFade: true,
      isLoadingSvg: true,
      currentComponent: "Menu",
    };
  },
  mounted() {
    this.isLoadingSvg = false;
    this.isFade = false;
  },
  methods: {
    // コンポーネント切り替え&ローディング開始
    switchTo(component) {
      this.isFade = true;
      setTimeout(() => {
        this.currentComponent = component;
        this.isLoadingSvg = true;
      }, 200); // 背景フェードイン待ち時間
    },
    // ローディング終了
    closeLoading() {
      this.isLoadingSvg = false;
      this.isFade = false;
    },
  },
};
</script>

<style scoped>
.contents-container {
  white-space: nowrap;
}

.loading {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: white;
  z-index: 1;
}

.v-enter-active,
.v-leave-active {
  transition: opacity 0.2s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
