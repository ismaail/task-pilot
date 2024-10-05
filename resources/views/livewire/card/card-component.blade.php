<div
		wire:sortable-group.item="{{ $card->id }}"
		class="group min-h14 px-2 py-2 space-y-0 rounded bg-white shadowxl border-2 border-gray-200 [body:not(.sorting)_&]:hover:border-secondary/20 text-sm">
	<div class="w-full flex space-x-2 justify-between items-start">
		{{--Card Name--}}
		<div class="flex items-start">
			<x-icons.dragable wire:sortable-group.handle class="shrink-0 fill-black text-black hover:cursor-move size-5" aria-hidden="true"></x-icons.dragable>
			<span class="line-clamp-3 select-none">{{ $card->name }}</span>
		</div>
		{{--Run Task Button--}}
		@if ($card->isCurrent())
			<button
					wire:click="stop"
					class="mt-0.5 fill-blue-500 hover:fill-red-500 text-blue-600 hover:text-red-600" title="Stop">
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
		<x-utils.dropdown-button>
			<button
					wire:click="$dispatch('openModal', { component: 'card.modals.edit-card', arguments: { card: {{ $card->id }} } })"
					class="dropdown-button">
				<x-icons.pencil class="size-4 fill-transparent"></x-icons.pencil>
				<span>Edit</span>
			</button>
			<hr class="h-0.5 border-t-0 bg-neutral-100 dark:bg-white/10">
			<button
					wire:click="delete"
					wire:confirm="Are you sure to delete this Card ?"
					class="dropdown-button text-red-500">
				<x-icons.trash class="size-4 fill-transparent"></x-icons.trash>
				<span>Delete</span>
			</button>
		</x-utils.dropdown-button>
	</footer>
</div>
