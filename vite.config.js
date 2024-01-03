import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin'
const host = 'my-app.test'; 
export default defineConfig({
    server: {
        https: false,
        host: '0.0.0.0', 
        hmr: {
            host: 'onnix-pay.test', //your <any_folder_name> host 
            protocol: 'ws',
            https: false,
        }
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
