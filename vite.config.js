import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',          // necessário para aceitar conexões externas (Docker)
        port: 5173,               // exposto no docker-compose
        hmr: {
            host: 'localhost',    // usado pelo navegador (acesso externo)
            protocol: 'ws',
        },
    },
})
