import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS All
                'resources/css/app.css', 

                // JS Public
                'resources/js/public/app.js',
                'resources/js/public/modules/contact.js',
                'resources/js/public/modules/home.js',
                'resources/js/public/modules/portfolio.js',
                'resources/js/public/modules/product.js',

                // JS Admin
                'resources/js/admin/app.js',
                'resources/js/admin/modules/dashboard.js',
                'resources/js/admin/modules/products.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
