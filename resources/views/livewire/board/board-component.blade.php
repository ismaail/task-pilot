<x-slot name="title">{{ $board->name }}</x-slot>
<div class="flex flex-col w-full px-4 pb-4">
	<div class="flex p-4 bg-white/5 rounded">
		<h1 class="text-lg font-semibold text-white bg">Board: {{ $board->name }}</h1>
		<x-utils.dropdown-button :dark="true">
			<a href="{{ route('boards.timelogs', $board->id) }}"
					class="dropdown-button">
				<span>Timelogs</span>
			</a>
		</x-utils.dropdown-button>
	</div>
	{{-- Buckets --}}
	<div
			wire:sortable="sortBuckets"
			wire:sortable-group="sortCards"
			class="flex w-full flex-grow items-start overflow-y-hidden mt-4 space-x-3">
		@foreach($buckets as $bucket)
			<livewire:bucket.bucket-component :key="$bucket->id" :bucket="$bucket" />
		@endforeach
			<button class="flex items-center gap-x-1 w-72 p-2 rounded text-white hover:text-primary font-semibold cursor-pointer">
				<x-icons.plus class="size-5" /> New Bucket
			</button>
	</div>
</div>
