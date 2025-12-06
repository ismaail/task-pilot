import { fileURLToPath, URL } from 'node:url';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
	plugins: [
		laravel({
			input: [
				'resources/assets/css/app.css',
				'resources/assets/js/app.js',
				'resources/assets/js/chart.js',
			],
			refresh: true,
		}),
		tailwindcss(),
	],
	resolve: {
		alias: {
			'~': fileURLToPath(new URL('./resources/assets/js', import.meta.url)),
			'@livewire': fileURLToPath(new URL('./vendor/livewire/livewire/dist', import.meta.url)),
			'/images': '/public/images',
		}
	}
});
