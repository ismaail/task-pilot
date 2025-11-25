<div
		wire:sortable.item="{{ $bucket->id }}"
		class="basis-72 shrink-0 p-2 space-y-2 rounded bg-gray-300 max-h-full overflow-y-auto scrollbar border-2 border-gray-700">
	{{-- Bucket Name & Tasks Count --}}
	<div class="flex items-start justify-between">
		{{-- Bucket Title + Cards/ count --}}
		<div class="flex gap-x-0.5 items-start">
			<x-icons.dragable wire:sortable.handle class="shrink-0 mt-0.5 fill-text text-text hover:cursor-move size-5" aria-hidden="true"></x-icons.dragable>
			<h2 class="text-base text-text font-semibold">{{ $bucket->name }}<span class="inline-block ml-2 text-xs">( {{ $cards->count() }} Tasks )</span></h2>
		</div>
		{{-- Dropdown Button --}}
		<x-utils.dropdown-button>
			<button
				class="dropdown-button">
				<x-icons.pencil class="size-4 fill-transparent"></x-icons.pencil>
				<span>@lang('Edit')</span>
			</button>
			<hr class="h-0.5 border-t-0 bg-neutral-100 dark:bg-white/10">
			<button
				wire:confirm="Are you sure to archive this Card ?"
				class="dropdown-button">
				<x-icons.archive class="size-4 fill-transparent"></x-icons.archive>
				<span>@lang('Archive')</span>
			</button>
			<button
				wire:confirm="Are you sure to delete this Card ?"
				class="dropdown-button text-red-500">
				<x-icons.trash class="size-4 fill-transparent"></x-icons.trash>
				<span>@lang('Delete')</span>
			</button>
		</x-utils.dropdown-button>
	</div>
	{{-- Add Button --}}
	<button
			wire:click="$dispatch('openModal', { component: 'card.modals.create-card', arguments: { bucket: {{ $bucket->id }} } })"
			class="group w-full px-2 py-1 rounded bg-white/30 hover:bg-gray-400 shadow shadow-black/15 transition-colors cursor-pointer"
			title="Add New Task"
	>
		<x-icons.plus class="mx-auto group-hover:text-text"></x-icons.plus>
	</button>
	{{-- Cards --}}
	<div
		wire:sortable-group.item-group="{{ $bucket->id }}"
		class="space-y-2 min-h-16">
		@foreach($cards as $card)
			<livewire:card.card-component :key="$card->id" :card="$card" />
		@endforeach
	</div>
</div>
