import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
    build: {
        outDir: 'src/public/build',
        manifest: true,
        rollupOptions: {
            input: {
                'script': resolve(__dirname, 'assets/script.js'),
                'style': resolve(__dirname, 'assets/style.css'),
            }
        }
    }
});
