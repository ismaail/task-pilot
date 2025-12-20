import Toastify from 'toastify-js';

document.addEventListener('livewire:initialized', () => {
	const tostifyCustomClose = globalThis.tostifyCustomClose = (el) => {
		const parent = el.closest('.toastify');
		const close = parent.querySelector('.toast-close');

		close.click();
	}

	window.addEventListener('toast', (event) => {
		const toastData = event.detail[0];

		const toastMarkup = `
			<div class="max-w-xs bg-${toastData.className || 'primary'} text-sm text-white rounded-xl shadow-lg" role="alert" tabindex="-1" aria-labelledby="hs-toast-solid-color-teal-label">
				<div id="hs-toast-solid-color-red-label" class="flex p-4 gap-4">
					${toastData.text}
					<div class="ms-auto ${toastData.close ? '' : 'hidden'}">
						<button onclick="tostifyCustomClose(this)" type="button" class="inline-flex shrink-0 justify-center items-center size-5 rounded-lg cursor-pointer text-white hover:text-white hover:opacity-80 focus:outline-hidden focus:opacity-100" aria-label="Close">
							<span class="sr-only">Close</span>
							<svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M18 6 6 18"></path>
								<path d="m6 6 12 12"></path>
							</svg>
						</button>
					</div>
				</div>
			</div>
		`;

		Toastify({
			style: {},
			text: toastMarkup,
			gravity: toastData.gravity || 'top',
			position: toastData.position || 'right',
			//className: 'hs-toastify-on:opacity-100 opacity-0 fixed -top-10 end-10 z-90 transition-all duration-300 w-72 bg-white text-sm text-gray-700 border border-gray-200 rounded-xl shadow-lg [&>.toast-close]:hidden dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400',
			stopOnFocus: true,
			duration: toastData.duration || 3000,
			close: toastData.close,
			escapeMarkup: false,
		}).showToast();
	});
});

