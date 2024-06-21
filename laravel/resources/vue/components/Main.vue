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
  width: 90%;
  height: 86%;
  margin: 20px auto;
  overflow-x: auto;
  color: aliceblue;
  background-color: rgba(40, 40, 40, 0.5);
  border-radius: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.main-container::-webkit-scrollbar {
  display: none;
}
</style>
