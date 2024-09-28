<x-slot name="title">{{ $board->name }}</x-slot>
<div class="flex flex-col w-full px-4 pb-4">
	<div class="flex p-4 bg-white/5 rounded">
		<h1 class="text-lg font-semibold text-white bg">Board: {{ $board->name }}</h1>
		<div class="hs-dropdown ml-auto relative inline-flex">
			<button class="p-1 hover:bg-white/20 rounded-full">
				<x-icons.ellipsis-vertical class="size-5 text-white"></x-icons.ellipsis-vertical>
			</button>
			<div class="hs-dropdown-menu z-10 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-1 space-y-0.5 mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
				<a href="{{ route('boards.timelogs', $board->id) }}"
					class="dropdown-button">
					<span>Timelogs</span>
				</a>
			</div>
		</div>
	</div>
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
