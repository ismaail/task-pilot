/* global HSDropdown, Alpine */

import 'preline/dist/dropdown';
import '@nextapps-be/livewire-sortablejs'

window.addEventListener('refresh.preline.dropdown', () => {
	if (! HSDropdown) return;

	setTimeout(() => HSDropdown.autoInit(), 1000);
});
