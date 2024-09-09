<div wire:sortable.item="{{ $bucket->id }}" class="w-72 p-2 space-y-2 rounded bg-gray-100 max-h-full overflow-y-auto scrollbar">
	{{-- Bucket Name & Tasks Count --}}
	<div class="flex items-start justify-between">
		{{-- Bucket Title + Cards/ count --}}
		<div class="flex gap-x-0.5 items-start">
			<x-icons.dragable wire:sortable.handle class="shrink-0 mt-0.5 fill-black text-black hover:cursor-move size-5" aria-hidden="true"></x-icons.dragable>
			<h2 class="text-base font-semibold">{{ $bucket->name }}<span class="inline-block ml-2 text-xs text-gray-600">({{ $cards->count() }} Tasks)</span></h2>
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
