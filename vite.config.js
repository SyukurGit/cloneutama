


import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        
    ],
});




// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
//     // ===============================================
//     //      TAMBAHKAN BLOK 'server' INI
//     // ===============================================
//     server: {
//     host: '0.0.0.0', // agar bisa diakses dari perangkat manapun di jaringan lokal
//     port: 5173,      // opsional, default Vite
//     hmr: {
//         host: '192.168.115.241', // IP lokal laptop/PC kamu
//     }
// }

// });