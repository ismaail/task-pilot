<div class="min-h14 px-2 py-2 rounded bg-white shadowxl border-2 border-gray-200 hover:border-secondary/20 text-sm">
	<div class="group w-full flex space-x-2 justify-between items-start">
		{{--Card Name--}}
		<span class="line-clamp-3 select-none">{{ $card->name }}</span>
		{{--Run Task Button--}}
		@if ($card->isCurrent())
			<button
					wire:click="stop"
					class="mt-0.5 invisiblee group-hover:visible fill-blue-500 hover:fill-red-500 text-blue-600 hover:text-red-600" title="Stop">
				<x-icons.stop class="size-5"></x-icons.stop>
			</button>
		@else
			<button
					wire:click="start"
					class="mt-0.5 invisible group-hover:visible fill-white hover:fill-green-500 text-green-600" title="Start">
				<x-icons.play class="size-5"></x-icons.play>
			</button>
		@endif
	</div>
	@if($card->spent_seconds)
		<div class="flex mt-1 items-center space-x-0.5 text-gray-500 fill-white">
			<svg xmlns="http://www.w3.org/2000/svg" fill="fillColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
				<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
			</svg>
			<span class="text-xs">{{ $card->elapsed_time->toHuman() }}</span>
		</div>
	@endif
</div>
