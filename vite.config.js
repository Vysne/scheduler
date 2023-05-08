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
                'resources/sass/table.scss',
                'resources/sass/course.scss',
                'resources/sass/map.scss',
                'resources/sass/form.scss',
                'resources/sass/dropdown.scss',
                'resources/sass/time.scss',
                'resources/sass/calendar.scss',
                'resources/sass/application.scss',
                'resources/sass/courseSingle.scss',
                'resources/sass/profile.scss',
                'resources/js/app.js',
                'resources/js/login.js',
                'resources/js/navbar.js',
                'resources/js/sidebar.js',
                'resources/js/content.js',
                'resources/js/filter.js',
                'resources/js/table.js',
                'resources/js/course.js',
                'resources/js/map.js',
                'resources/js/form.js',
                'resources/js/dropdown.js',
                'resources/js/editCourse.js',
                'resources/js/calendar.js',
                'resources/js/notifiers.js',
                'resources/js/courseSingle.js',
                'resources/js/profile.js'
            ],
            refresh: true,
        }),
    ],
});
