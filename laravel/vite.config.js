import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/scss/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@": "/resources/vue",
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
            "~js": "/resources/js",
            "~scss": "/resources/scss",
            "~images": "/resources/images",
        },
    },
    server: {
        port: 5173,
        host: "0.0.0.0", // Codespacesなどの外部アクセスを許可するため
        hmr: {
            host: "bug-free-telegram-4wqvxvgq4rj256w-5173.app.github.dev", // ここにあなたのCodespaceのURLを入れます
            protocol: "wss",
            clientPort: 443,
        },
    },
});
