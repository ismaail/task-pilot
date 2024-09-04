<div class="w-72 p-2 space-y-2 rounded bg-gray-100 max-h-full overflow-y-auto scrollbar">
	{{-- Bucket Name & Tasks Count --}}
	<div class="flex items-start justify-between">
		{{-- Bucket Title + Cards/ count --}}
		<h2 class="text-base font-semibold">{{ $bucket->name }}<span class="block text-xs text-gray-600">{{ $bucket->cards->count() }} Tasks</span></h2>
		{{-- Create Task Button --}}
		<button
			wire:click="$dispatch('openModal', { component: 'card.modals.create-card', arguments: { bucket: {{ $bucket->id }} } })"
			class="px-2 rounded text-lg bg-gray-200 hover:bg-secondary hover:text-white"
			title="Add New Task"
		>&plus;</button>
	</div>
	<div
		x-sort.ghost="$wire.sort($item, $position)"
		x-sort:group="bucket"
		class="space-y-2 min-h-16">
		@foreach($bucket->cards as $card)
			<livewire:card.card-component
				:card="$card"
				:key="'Card::' . $card->id"
			></livewire:card.card-component>
		@endforeach
	</div>
</div>
