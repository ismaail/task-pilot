<x-slot name="title">{{ $board->name }}</x-slot>
<div class="flex flex-col w-full px-4 pb-4">
	<h1 class="p-4 flex items-center justify-between bg-white/5 rounded text-lg font-semibold text-white">
		Timelogs for: {{ $board->name }}
		<a href="{{ route('boards.show', $board->id) }}" class="text-white text-sm hover:underline">&#x2B8C; Back</a>
	</h1>
	<x-chart.time-chart-component :board-id="$board->id" />
</div>
