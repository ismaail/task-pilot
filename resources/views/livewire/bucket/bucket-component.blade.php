<div wire:sortable.item="{{ $bucket->id }}" class="w-72 p-2 space-y-2 rounded bg-gray-100 max-h-full overflow-y-auto scrollbar">
	{{-- Bucket Name & Tasks Count --}}
	<div class="flex items-start justify-between">
		{{-- Bucket Title + Cards/ count --}}
		<div class="flex gap-x-1 items-start">
			<svg wire:sortable.handle class="mt-0.5 invisiblegroup-hover:visible hover:cursor-move size-5" aria-hidden="true" viewBox="0 0 16 16"><path d="M10 13a1 1 0 100-2 1 1 0 000 2zm-4 0a1 1 0 100-2 1 1 0 000 2zm1-5a1 1 0 11-2 0 1 1 0 012 0zm3 1a1 1 0 100-2 1 1 0 000 2zm1-5a1 1 0 11-2 0 1 1 0 012 0zM6 5a1 1 0 100-2 1 1 0 000 2z"></path></svg>
			<h2 class="text-base font-semibold">{{ $bucket->name }}<span class="block text-xs text-gray-600">{{ $cards->count() }} Tasks</span></h2>
		</div>
		{{-- Create Task Button --}}
		<button
			wire:click="$dispatch('openModal', { component: 'card.modals.create-card', arguments: { bucket: {{ $bucket->id }} } })"
			class="px-2 rounded text-lg bg-gray-200 hover:bg-secondary hover:text-white"
			title="Add New Task"
		>&plus;</button>
	</div>
	{{-- Cards --}}
	<div
		wire:sortable-group.item-group="{{ $bucket->id }}"
		class="space-y-2 min-h-16">
		@foreach($cards as $card)
			<livewire:card.card-component :key="$card->id" :card="$card" />
		@endforeach
	</div>
</div>
