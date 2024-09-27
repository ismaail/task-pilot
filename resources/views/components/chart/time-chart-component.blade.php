<div class="mt-4 p-4 min-h-80 bg-white rounded">
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
