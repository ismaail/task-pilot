<x-slot name="title">{{ $board->name }}</x-slot>
<div class="flex flex-col w-full px-4 pb-4">
	<div class="flex p-4 bg-gray-300 rounded">
		<h1 class="text-lg font-semibold text-text">@lang('Board'): {{ $board->name }}</h1>
		<x-utils.dropdown class="ms-auto">
			<x-utils.dropdown-item>
				<a href="{{ route('boards.timelogs', $board->id) }}">
					<x-icons.clock class="size-4 fill-transparent"></x-icons.clock>
					<span>@lang('Timelogs')</span>
				</a>
			</x-utils.dropdown-item>
			<x-utils.dropdown-item>
				<button
						wire:click="delete"
						wire:confirm="Are you sure to delete this Board ?"
						class="text-red-500">
					<x-icons.trash class="size-4 fill-transparent"></x-icons.trash>
					<span>@lang('Delete')</span>
				</button>
			</x-utils.dropdown-item>
			<x-utils.dropdown-item>
				<button
						wire:click="archive"
						wire:confirm="Are you sure to archive this Board ?"
				>
					<x-icons.archive class="size-4 fill-transparent"></x-icons.archive>
					<span>@lang('Archive')</span>
				</button>
			</x-utils.dropdown-item>
		</x-utils.dropdown>
	</div>
	{{-- Buckets --}}
	<div
			wire:sortable="sortBuckets"
			wire:sortable-group="sortCards"
			class="flex w-full grow items-start overflow-y-hidden mt-4 pb-2 space-x-3 scrollbar">
		@foreach($buckets as $bucket)
			<livewire:bucket.bucket-component :key="$bucket->id" :bucket="$bucket" />
		@endforeach
			<button class="flex basis-36 shrink-0 items-center gap-x-1 w-72 p-2 rounded text-text hover:text-primary font-semibold cursor-pointer">
				<x-icons.plus class="size-5" /> @lang('New Bucket')
			</button>
	</div>
</div>
