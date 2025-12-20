<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ isset($title) ? $title . ' - ' . config('app.title') : config('app.title') }}</title>
	@if (Auth::user() && Auth::user()->current_card_id)
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon_busy.ico') }}">
	@else
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
	@endif
	{{-- @livewireStyles--}}
	@vite('resources/assets/css/app.css')
	<style>[x-cloak] {display: none;}</style>
	{{-- Dark Mode--}}
	<script>
		const changeDarkMode = (isDark) => {
			globalThis.DarkMode = isDark;

			if (isDark) {
				document.documentElement.setAttribute('data-mode', 'dark');
				localStorage.setItem('dark-mode', 'true');

				return;
			}

			document.documentElement.removeAttribute('data-mode');
			localStorage.setItem('dark-mode', 'false');
		};

		window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (event) => {
			changeDarkMode(event.matches);
		});

		const isDark = () => {
				return null !== localStorage.getItem('dark-mode')
					? localStorage.getItem('dark-mode') === 'true'
					:window.matchMedia('(prefers-color-scheme: dark)').matches;
		};

		changeDarkMode(isDark());

		document.addEventListener('livewire:navigated', () => changeDarkMode(isDark()));
	</script>
</head>
<body>
	{{-- Top Page Header --}}
	<nav class="w-full flex flex-wrap items-center justify-between p-4">
		{{-- Logo --}}
		<a wire:navigate href="{{ route('home') }}" class="flex items-center space-x-2">
			<picture>
				<source srcset="{{ asset('images/logo-dark.png') }}" class="h-8" w="48" height="32" media="(prefers-color-scheme:dark)">
				<img src="{{ asset('images/logo.png') }}" alt="{{ config('app.title') }}" class="h-8" w="48" height="32">
			</picture>
			<span class="self-center text-3xl font-semibold whitespace-nowrap text-primary">{{ config('app.title') }}</span>
		</a>
		{{-- Profile Dropdown Menu --}}
		<x-utils.dropdown>
			<x-slot name="trigger">
				<img src="{{ asset('images/avatar.png') }}" alt="{{ auth()->user()->name }}" class="size-8 cursor-pointer">
			</x-slot>
			<x-utils.dropdown-item><a href="{{ route('profile.timelogs') }}" class="py-2px-3dropdown-item-icon"><span>@lang('Timelogs')</span></a></x-utils.dropdown-item>
		</x-utils.dropdown>
	</nav>
	<div class="flex flex-grow w-full overflow-y-hidden">
		{{ $slot }}
	</div>
	{{--<livewire:utils.notice />--}}
	@persist('pomodoro')
		<livewire:pomodoro />
	@endpersist
	@livewire('wire-elements-modal')
	@vite('resources/assets/js/app.js')
	@stack('javascript')
</body>
</html>
