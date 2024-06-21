<template>
  <div class="contents-container">
    <div class="contents-item">
      <Menu
        @scroll-to-search-youtube-channel="scrollToSearchYoutubeChannel"
        @scroll-to-about="scrollToAbout"
        @scroll-to-clip-list="scrollToClipList"
      />
    </div>
    <div class="contents-item" ref="searchYoutubeChannelSection">
      hogeB
      <!--SearchYoutubeChannel
        :visible="visibleSearchYoutubeChannel"
        @scroll-to-menu="scrollToMenu"
      /-->
    </div>
    <div class="contents-item" ref="clipListSection">
      <ClipList :visible="visibleClipList" />
    </div>
    <div class="contents-item" ref="aboutSection">
      <About :visible="visibleAbout" ref="aboutSection" />
    </div>
  </div>
</template>

<script>
import Menu from "@/components/Menu.vue";
// import SearchYoutubeChannel from "@/components/SearchYoutubeChannel.vue";
import ClipList from "@/components/ClipList.vue";
import About from "@/components/About.vue";

export default {
  components: {
    Menu,
    // SearchYoutubeChannel,
    ClipList,
    About,
  },
  data() {
    return {
      visibleSearchYoutubeChannel: false,
      visibleClipList: true,
      visibleAbout: true,
    };
  },
  methods: {
    hideAll() {
      this.visibleSearchYoutubeChannel = false;
      this.visibleClipList = false;
      this.visibleAbout = false;
    },
    scrollToMenu() {
      const section = this.$refs.menuSection;
      section.scrollIntoView({ behavior: "smooth" });
      this.hideAll();
    },
    scrollToSearchYoutubeChannel() {
      this.visibleSearchYoutubeChannel = true;
      const section = this.$refs.searchYoutubeChannelSection;
      section.scrollIntoView({ behavior: "smooth" });
    },
    scrollToClipList() {
      this.visibleClipList = true;
      const section = this.$refs.clipListSection;
      section.scrollIntoView({ behavior: "smooth" });
    },
    scrollToAbout() {
      this.visibleAbout = true;
      const section = this.$refs.aboutSection;
      section.scrollIntoView({ behavior: "smooth" });
    },
  },
};
</script>

<style scoped>
.contents-container {
  display: flex;
  overflow-x: auto;
  width: 100%;
  height: 100%;
  white-space: nowrap;
}

.contents-item {
  flex: 0 0 100%;
  /* flex: 1; */
  box-sizing: border-box;
  padding: 10px;
}
</style>
