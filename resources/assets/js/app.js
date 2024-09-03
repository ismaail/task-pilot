/* global HSDropdown */

import { dropdown } from 'preline/dist/dropdown';

window.addEventListener('refresh.preline.dropdown', () => {
	if (! HSDropdown) return;

	setTimeout(() => HSDropdown.autoInit(), 1000);
});
