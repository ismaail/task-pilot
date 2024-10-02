<div {{ $attributes->twMerge('relative p-4 w-full sm:w-[608px] h-auto sm:h-80 bg-white rounded') }}>
	<canvas id="time-chart" class=""></canvas>
</div>

@push('javascript')
	<script>
		window.timeChart = {
			labels: @json($labels),
			{{--data: @json($timelogs->pluck('total_seconds')->toArray()),--}}
			data: @json($data),
		};
	</script>
	@vite('resources/assets/js/chart.js')
@endpush
