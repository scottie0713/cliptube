import { createApp } from 'vue';
import App from '../vue/App.vue'; // ルートコンポーネント

const app = createApp(App);
//app.config.devtools = true;

// 必要に応じて他のプラグインやコンポーネントを登録
// 例: app.use(router); 

app.mount('#app');