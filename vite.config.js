import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin'
const host = 'my-app.test'; 
export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
                'app/Forms/Components/**',
            ],
        }),
    ],
})
