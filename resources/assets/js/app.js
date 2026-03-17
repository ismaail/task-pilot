/* global HSDropdown, Livewire */

import { HSDropdown } from 'preline';
import '@wotz/livewire-sortablejs';
import '~/toastify.js';

document.addEventListener('livewire:initialized', () => {
	window.addEventListener('refresh.preline.dropdown', () => {
		//setTimeout(() => HSDropdown.autoInit(), 1000);
		window.HSStaticMethods.autoInit(['dropdown']);
	});

	window.addEventListener('swap-favicon', (event) => {
		const favicon = document.querySelector('link[rel="icon"]');

		favicon.setAttribute('href', event.detail[0].is_busy ? '/favicon_busy.ico' : '/favicon.ico');
	});
});

Livewire.on('notification.show', (title, description) => showNotification(title, description));

const showNotification = (title, description, iconUrl = '/images/logo-dark.png') => {
	// 1. Check if the browser supports notifications
	if (!('Notification' in window)) {
		console.error('This browser does not support desktop notification');
		return;
	}

	// 2. Check permission and request if needed
	if ('granted' === Notification.permission) {
		createNotification(title, description, iconUrl);
	} else if ('denied' !== Notification.permission) {
		Notification.requestPermission().then(permission => {
			if ('granted' === permission) {
				createNotification(title, description, iconUrl);
			}
		});
	}
}

function createNotification(title, description, iconUrl) {
	new Notification(title, {
		body: description,
		icon: iconUrl,
		badge: iconUrl,
	});
}
