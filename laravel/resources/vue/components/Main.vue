<template>
  <div class="main-container">
    <Contents />
  </div>
</template>

<script>
import Contents from "@/components/Contents.vue";

export default {
  components: {
    Contents,
  },
  data() {
    return {};
  },
  methods: {},
};
</script>

<style scoped>
.main-container {
  position: absolute;
  width: 90%;
  min-width: 480px;
  height: 86%;
  top: 3em;
  right: 0;
  bottom: 0;
  left: 0;
  margin: auto;
  padding: 20px;
  overflow-x: auto;
  overflow-wrap: break-word;
  color: aliceblue;
  background-color: rgba(40, 40, 40, 0.5);
  border-radius: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.main-container::-webkit-scrollbar {
  display: none;
}
</style>
