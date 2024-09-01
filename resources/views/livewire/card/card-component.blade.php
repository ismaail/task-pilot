<div class="group w-full flex space-x-2 justify-between items-start min-h14 px-2 py-2 rounded bg-white shadowxl border-2 border-gray-200 hover:border-secondary/20 text-sm">
	{{--Card Name--}}
	<span class="line-clamp-3 select-none">{{ $card->name }}</span>
	{{--Run Task Button--}}
	@if ($card->isCurrent())
		<button
				wire:click="stop"
				class="mt-0.5 invisiblee group-hover:visible fill-blue-500 hover:fill-red-500 text-blue-600 hover:text-red-600" title="Stop">
			<svg xmlns="http://www.w3.org/2000/svg" fill="fillColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0 1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z" />
			</svg>
		</button>
	@else
		<button
				wire:click="start"
				class="mt-0.5 invisible group-hover:visible fill-white hover:fill-green-500 text-green-600" title="Start">
			<svg xmlns="http://www.w3.org/2000/svg" fill="fillColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
			</svg>
		</button>
	@endif
</div>
