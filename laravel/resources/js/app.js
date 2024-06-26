import { createApp } from 'vue';
import App from '@/App.vue'; // ルートコンポーネント
import router from './router';

createApp(App).use(router).mount('#app');