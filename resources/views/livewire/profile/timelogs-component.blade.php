<x-slot name="title">@lang('Profile') @lang('Timelogs')</x-slot>
<div class="flex flex-col w-full px-4 pb-4">
	<h1 class="p-4 flex items-center justify-between bg-gray-300 rounded text-lg font-semibold text-text">
		@lang('Profile') &gt; @lang('Timelogs')
	</h1>
	<main class="xl:flex items-start mt-4 space-y-4 xl:space-y-0">
		<x-chart.time-chart-component class="shrink-0" />
		<ul class="xl:w-[530px] grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-2 gap-4 xl:mx-4 text-text font-semibold">
			<li class="flex justify-between xl:w-64 p-4 border border-gray-700 rounded">Today<span>{{ $today->toHumanMinimal() }}</span></li>
			<li class="flex justify-between xl:w-64 p-4 border border-gray-700 rounded">Yesterday<span>{{ $yesterday->toHumanMinimal() }}</span></li>
			<li class="flex justify-between xl:w-64 p-4 border border-gray-700 rounded">This Week<span>{{ $week->toHumanMinimal() }}</span></li>
			<li class="flex justify-between xl:w-64 p-4 border border-gray-700 rounded">This Month<span>{{ $month->toHumanMinimal() }}</span></li>
			<li class="flex justify-between xl:w-64 p-4 border border-gray-700 rounded">Last Month<span>{{ $last_month->toHumanMinimal() }}</span></li>
		</ul>
	</main>
</div>
