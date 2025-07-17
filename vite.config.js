


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
//     server: {
//         host: '0.0.0.0',
//         port: 5173,
//         strictPort: true,
//     },
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
// });






























// import { defineConfig } from 'vite'
// import laravel from 'laravel-vite-plugin'
// import tailwindcss from '@tailwindcss/vite'

// export default defineConfig({
//   server: {
//     host: '0.0.0.0', // biar bisa diakses dari IP manapun
//     port: 5173,      // default Vite port
//     hmr: {
//       host: '192.168.154.223', // IP lokal kamu
//     },
//   },
//   plugins: [
//     tailwindcss(),
//     laravel({
//       input: ['resources/css/app.css', 'resources/js/app.js'],
//       refresh: true,
//     }),
//   ],
// })
