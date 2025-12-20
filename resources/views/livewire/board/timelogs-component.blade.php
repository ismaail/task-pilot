<x-slot name="title">{{ $board->name }}</x-slot>
<div class="flex flex-col w-full px-4 pb-4">
	<h1 class="p-4 flex items-center justify-between bg-gray-300 rounded text-lg font-semibold text-text">
		@lang('Timelogs') : {{ $board->name }}
		<a href="{{ route('boards.show', $board->id) }}" class="text-text text-sm hover:underline"><span class="text-lg">&#x2B8C;</span> @lang('Back')</a>
	</h1>
	<main class="mt-4">
		<x-chart.time-chart-component :board-id="$board->id" />
	</main>
</div>
