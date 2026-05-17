<x-slot name="title">Boards</x-slot>
<div class="flex flex-col w-full px-4 pb-4">
	<h1 class="p-4 bg-gray-300 rounded text-lg font-semibold text-text">@lang('All Boards')</h1>
	<div
			wire:sortable="sortBoards"
			class="flex flex-row flex-wrap w-full grow items-start content-start justify-start mt-4 gap-4">
		@foreach($boards as $board)
			<div
					wire:sortable.item="{{ $board->id }}"
					class="flex items-start basis-50 min-h-40 shrink-0 w-72 p-2 space-y-2 rounded border border-gray-400/40 bg-gray-300 text-text font-semibold">
				<div class="flex gap-x-0.5 items-start">
					<x-icons.dragable wire:sortable.handle class="shrink-0 mt-0.5 fill-text text-text hover:cursor-move size-5" aria-hidden="true"></x-icons.dragable>
					<a wire:navigate href="{{ route('boards.show', $board->id) }}" class="hover:text-primary transition-colors">{{ $board->name }}</a>
				</div>
				@if ($current_board_id === $board->id)
					<x-icons.play class="ms-auto size-5 fill-primary text-primary"></x-icons.play>
				@endif
			</div>
		@endforeach
		<button
				wire:click="$dispatch('openModal', { component: 'board.modals.create-board'})"
				title="Create new Board"
				class="flex basis-36 shrink-0 items-center gap-x-1 w-72 p-2 rounded text-text hover:text-primary font-semibold cursor-pointer">
			<x-icons.plus class="size-5" /> New Board
		</button>
	</div>
</div>
