import { fileURLToPath, URL } from 'node:url';

import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
	plugins: [
		laravel({
			input: [
				'resources/assets/css/app.css',
				'resources/assets/js/app.js',
				'resources/assets/js/chart.js',
			],
			refresh: [
				...refreshPaths,
				'app/Filament/**',
				'app/Forms/Components/**',
				'app/Livewire/**',
				'app/Infolists/Components/**',
				'app/Providers/Filament/**',
				'app/Tables/Columns/**',
			],
		}),
	],
	resolve: {
		alias: {
			'~': fileURLToPath(new URL('./resources/assets/js', import.meta.url)),
			'@livewire': fileURLToPath(new URL('./vendor/livewire/livewire/dist', import.meta.url)),
		}
	}
});
