/* global HSDropdown, Livewire */

import 'preline/dist/dropdown';
import '@nextapps-be/livewire-sortablejs';

document.addEventListener('livewire:initialized', () => {
	window.addEventListener('refresh.preline.dropdown', () => {
		if (! HSDropdown) {
			return;
		}

		setTimeout(() => HSDropdown.autoInit(), 1000);
	});

	window.addEventListener('notice.add', (event) => {
		Livewire.dispatch('notice', event.detail[0]);
	});
});
