<div class="flex flex-col w-full px-4 pb-4">
	<h1 class="p-4 bg-white/5 rounded text-lg font-semibold text-white">Board: {{ $board->name }}</h1>
	<div class="flex w-full flex-grow items-start overflow-y-hidden mt-4 space-x-3">
		@foreach($board->buckets as $bucket)
			<div class="w-64 p-2 space-y-2 rounded bg-gray-100 max-h-full overflow-y-auto scrollbar">
				<h2 class="text-base font-semibold">{{ $bucket->name }}</h2>
				@foreach($bucket->tasks as $task)
					<div class="w-full min-h14 px-2 py-2 rounded bg-white shadowxl border-2 border-gray-200 hover:border-blue-400 text-sm cursor-pointer">
						<span class="line-clamp-3">{{ $task->name }}</span>
					</div>
				@endforeach
			</div>
		@endforeach
	</div>
</div>
