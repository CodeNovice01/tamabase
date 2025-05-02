import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'], // Viteで読み込むエントリーファイルを指定してるよ
      refresh: true, // BladeファイルやJSファイルを変更したら自動リロードしてくれるよ
    }),
    tailwindcss(), // Tailwind CSSをVite経由で使えるようにしてるよ
  ],
  server: {
    cors: true, // APIとのやりとりやCookie送信時に必要になる場合があるよ
  },
});
