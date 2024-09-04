<div
		x-sort:item="{{ $card->id }}"
		class="min-h14 px-2 py-2 space-y-0 rounded bg-white shadowxl border-2 border-gray-200 [body:not(.sorting)_&]:hover:border-secondary/20 text-sm">
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
	<footer class="flex">
		@if($card->spent_seconds)
			<div class="flex mt-1 items-center space-x-0.5 text-gray-500 fill-white">
				<x-icons.clock class="size-4"></x-icons.clock>
				<span class="text-xs">{{ $card->elapsed_time->toHuman() }}</span>
			</div>
		@endif
		{{-- Dropdown --}}
		<div class="hs-dropdown ml-auto relative inline-flex">
			<button class="p-1 hover:bg-gray-200 rounded-full">
				<x-icons.ellipsis-vertical class="size-5"></x-icons.ellipsis-vertical>
			</button>
			<div
					{{--style="position: fixed; inset: 0 auto auto 0; margin: 0; transform: translate(258px, 270px); display: block; opacity: 1"--}}
					class="hs-dropdown-menu z-10 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-1 space-y-0.5 mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
				<button
					wire:click="$dispatch('openModal', { component: 'card.modals.edit-card', arguments: { card: {{ $card->id }} } })"
						class="dropdown-button">
					<x-icons.pencil class="size-4 fill-transparent"></x-icons.pencil>
					<span>Edit</span>
				</button>
				<hr class="h-0.5 border-t-0 bg-neutral-100 dark:bg-white/10">
				<button class="dropdown-button">
					<x-icons.trash class="size-4 fill-transparent"></x-icons.trash>
					<span>Delete</span>
				</button>
			</div>
		</div>
	</footer>
</div>
