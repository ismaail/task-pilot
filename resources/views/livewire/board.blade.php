<div class="flex flex-col w-full px-4 pb-4">
	<h1 class="p-4 bg-white/5 rounded text-lg font-semibold text-white">Board: {{ $board->name }}</h1>
	<div class="flex w-full flex-grow items-start overflow-y-hidden mt-4 space-x-3">
		@foreach($board->buckets as $bucket)
			<div class="w-72 p-2 space-y-2 rounded bg-gray-100 max-h-full overflow-y-auto scrollbar" wire:key="{{ 'Bucket::' . $bucket->id }}">
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
				@forelse($bucket->cards as $card)
					<livewire:card.card-component
						:card="$card"
						wire:key="{{ 'Card::' . $card->id }}"
					></livewire:card.card-component>
				@empty
					{{-- Create First Task Button --}}
					<button
							id="task-btn"
							wire:click="$dispatch('openModal', { component: 'card.modals.create-card', arguments: { bucket: {{ $bucket->id }} } })"
							class="w-full px-2 py-1 rounded bg-gray-200 hover:bg-secondary font-semibold hover:text-white"
					>&plus; Add Task</button>
				@endforelse
			</div>
		@endforeach
	</div>
</div>
