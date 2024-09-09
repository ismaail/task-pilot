<div class="flex flex-col w-full px-4 pb-4">
	<h1 class="p-4 bg-white/5 rounded text-lg font-semibold text-white">Board: {{ $board->name }}</h1>
	{{-- Buckets --}}
	<div
			wire:sortable="sortBuckets"
			wire:sortable-group="sortCards"
			class="flex w-full flex-grow items-start overflow-y-hidden mt-4 space-x-3">
		@foreach($buckets as $bucket)
			<livewire:bucket.bucket-component :key="$bucket->id" :bucket="$bucket" />
		@endforeach
	</div>
</div>
