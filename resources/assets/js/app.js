/* global HSDropdown, Alpine */

import 'preline/dist/dropdown';
import sort from '@alpinejs/sort';

window.addEventListener('refresh.preline.dropdown', () => {
	if (! HSDropdown) return;

	setTimeout(() => HSDropdown.autoInit(), 1000);
});

Alpine.plugin(sort);
