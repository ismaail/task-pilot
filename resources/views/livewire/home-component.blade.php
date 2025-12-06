<x-slot name="title">Boards</x-slot>
<div class="flex flex-col w-full px-4 pb-4">
	<h1 class="p-4 bg-gray-300 rounded text-lg font-semibold text-text">@lang('All Boards')</h1>
	<div class="flex w-full flex-grow items-start overflow-y-hidden mt-4 space-x-3">
		@foreach($boards as $board)
			<a href="{{ route('boards.show', $board->id) }}" class="flex basis-48 shrink-0 items-center w-72 p-2 space-y-2 rounded bg-gray-300 hover:contrast-75 text-text font-semibold">
				{{ $board->name }}
				@if ($current_board_id === $board->id)
					<x-icons.play class="ms-auto size-5 fill-primary text-primary"></x-icons.play>
				@endif
			</a>
		@endforeach
			<button
					wire:click="$dispatch('openModal', { component: 'board.modals.create-board'})"
					title="Create new Board"
					class="flex basis-36 shrink-0 items-center gap-x-1 w-72 p-2 rounded text-text hover:text-primary font-semibold cursor-pointer">
				<x-icons.plus class="size-5" /> New Board
			</button>
	</div>
</div>
