import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/app.scss',
                'resources/sass/login.scss',
                'resources/sass/navbar.scss',
                'resources/sass/sidebar.scss',
                'resources/sass/content.scss',
                'resources/sass/page-title.scss',
                'resources/sass/filter.scss',
                'resources/js/app.js',
                'resources/js/login.js',
                'resources/js/navbar.js',
                'resources/js/sidebar.js',
                'resources/js/content.js',
                'resources/js/filter.js'
            ],
            refresh: true,
        }),
    ],
});
