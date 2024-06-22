<template>
  <div class="contents-container">
    <!-- <button @click="hoge()">Toggle2</button> -->
    <Loading v-show="isLoadingSvg" />
    <Transition>
      <div v-show="isFade" class="loading"></div>
    </Transition>
    <component
      :is="currentComponent"
      @navigate="navigate"
      @close-loading="closeLoading"
    />
  </div>
</template>

<script>
import Loading from "@/components/Loading.vue";
import Menu from "@/components/Menu.vue";
// import SearchYoutubeChannel from "@/components/SearchYoutubeChannel.vue";
import ClipList from "@/components/ClipList.vue";
import About from "@/components/About.vue";

export default {
  components: {
    Loading,
    Menu,
    // SearchYoutubeChannel,
    ClipList,
    About,
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
    navigate(component) {
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
  position: absolute;
  overflow-x: auto;
  width: 90%;
  height: 86%;
  border-radius: 20px;
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
  /* height: 100%;
  transition: height 0.3s ease-in-out; */
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
  /* height: 0; */
}
</style>
