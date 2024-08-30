<div class="flex flex-col w-full px-4 pb-4">
	<h1 class="p-4 bg-white/5 rounded text-lg font-semibold text-white">Board: {{ $board->name }}</h1>
	<div class="flex w-full flex-grow items-start overflow-y-hidden mt-4 space-x-3">
		@foreach($board->buckets as $bucket)
			<div class="w-64 p-2 space-y-2 rounded bg-gray-100 max-h-full overflow-y-auto scrollbar">
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
					<div class="w-full min-h14 px-2 py-2 rounded bg-white shadowxl border-2 border-gray-200 hover:border-secondary text-sm cursor-pointer">
						<span class="line-clamp-3 select-none">{{ $card->name }}</span>
					</div>
				@empty
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
