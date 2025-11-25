<div {{ $attributes->twMerge('hs-dropdown relative inline-flex [--auto-close:inside]') }}>
	@isset($trigger)
		{{ $trigger }}
	@else
		<button class="group rounded-full hover:bg-gray-light cursor-pointer">
			<x-icons.ellipsis-vertical class="p-1 size-6 text-text hover:bg-gray-700/70 rounded-full"></x-icons.ellipsis-vertical>
		</button>
	@endisset
		<div
				class="hs-dropdown-menu z-10 min-w-20 p-1 space-y-0.5 mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4
							before:start-0 before:w-full transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden bg-gray-700 rounded-lg border border-gray-300 shadow-md"
			role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
			{{ $slot }}
		</div>
</div>
