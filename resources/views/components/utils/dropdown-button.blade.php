@props([
	'dark' => false,
])

<div {{ $attributes->twMerge('hs-dropdown ml-auto relative inline-flex') }}>
	@isset($icon)
		{{ $icon }}
	@else
		<button
				@class(['p-1 rounded-full', 'hover:bg-white/20' => $dark, 'hover:bg-gray-200' => !$dark])>
			<x-icons.ellipsis-vertical
					@class(['size-5', 'text-text'])
			></x-icons.ellipsis-vertical>
		</button>
	@endisset
		<div class="hs-dropdown-menu min-w-40 mt-2 px-2 p-1 space-y-0.5 z-10 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden bg-gray-300 shadow-md rounded border border-gray-700
		after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full text-text"
			role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
			{{ $slot }}
		</div>
</div>
