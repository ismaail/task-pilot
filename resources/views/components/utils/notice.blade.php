{{-- @see https://codepen.io/KevinBatdorf/pen/JjGKbMa?editors=1010 --}}
<div>
	<div
		x-data="noticesHandler()"
		@class([
			'fixed right-0 left-auto inset-0 flex items-end justify-start p-4 space-y-4 h-screen w-0',
			$position,
		])
		@notice.window="add($event.detail)"
		style="pointer-events:none">
		<template x-for="notice of notices" :key="notice.id">
			<div
					x-show="visible.includes(notice)"
					x-transition:enter="transition ease-in duration-200"
					x-transition:enter-start="transform opacity-0 translate-y-2"
					x-transition:enter-end="transform opacity-100"
					x-transition:leave="transition ease-out duration-500"
					x-transition:leave-start="transform translate-x-0 opacity-100"
					x-transition:leave-end="transform translate-x-full opacity-0"
					class="max-wxs min-w-80 text-sm text-white rounded-xl shadow-lg" role="alert" tabindex="-1" aria-labelledby="hs-toast-solid-color-teal-label"
					:class="{
							'bg-teal-500': notice.type === 'success',
							'bg-blue-500': notice.type === 'info',
							'bg-orange-500': notice.type === 'warning',
							'bg-red-500': notice.type === 'error',
						}"
					style="pointer-events:all"
			>
				<div class="flex px-4 pt-4 pb-2 items-start">
					<p x-text="notice.text" class="text-pretty"></p>
					<div class="ms-auto">
						<button @click="remove(notice.id)" type="button" class="inline-flex shrink-0 justify-center items-center rounded-lg text-white hover:text-white opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100" aria-label="Close">
							<span class="sr-only">Close</span>
							<x-icons.close></x-icons.close>
						</button>
					</div>
				</div>
			</div>
		</template>
	</div>
</div>

@push('javascript')
	<script>
		const autoClose = {{ $autoClose ? 'true' : 'false' }} ;
		const timeClose = {{ $timeClose }};

		function noticesHandler() {
			return {
				notices: [],
				visible: [],
				add(notice) {
					notice.id = Date.now();
					this.notices.push(notice);
					this.fire(notice.id);
				},
				fire(id) {
					this.visible.push(this.notices.find((notice) => notice.id === id));

					if (! autoClose) return;

					const timeShown = timeClose * this.visible.length;
					setTimeout(() => {
						this.remove(id)
					}, timeShown);
				},
				remove(id) {
					const notice = this.visible.find((notice) => notice.id === id);
					const index = this.visible.indexOf(notice);
					this.visible.splice(index, 1);
				},
			}
		}
	</script>
@endpush
