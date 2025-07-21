


// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
        
//     ],
// });




import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // ===============================================
    //      TAMBAHKAN BLOK 'server' INI
    // ===============================================
    server: {
        host: '192.168.114.117', // <-- Gunakan IP-mu di sini
        hmr: {
            host: '192.168.114.117',
        }
    }
});