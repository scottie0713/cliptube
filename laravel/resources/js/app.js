import { createApp } from "vue";
import App from "@/App.vue"; // ルートコンポーネント
import router from "./router";
import "bootstrap-vue/dist/bootstrap-vue.css";

const app = createApp(App);
app.use(router).mount("#app");
