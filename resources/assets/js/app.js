/* global HSDropdown */

import 'preline/dist/dropdown';
import '@nextapps-be/livewire-sortablejs';

document.addEventListener('livewire:initialized', () => {
	window.addEventListener('refresh.preline.dropdown', () => {
		if (! HSDropdown) {
			return;
		}

		setTimeout(() => HSDropdown.autoInit(), 1000);
	});

	const favicon = document.querySelector('link[rel="icon"]');
	window.addEventListener('swap-favicon', (event) => {
		favicon.setAttribute('href', event.detail[0].is_busy ? '/favicon_busy.ico' : '/favicon.ico');
	});
});
