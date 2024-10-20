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
	@livewireStyles
	@vite('resources/assets/css/app.css')
</head>
<body>
	<nav class="w-full flex flex-wrap items-center justify-between p-4">
		<a href="{{ route('home') }}" class="flex items-center space-x-2">
			<img src="{{ asset('images/logo-m.jpg') }}" class="h-8" alt="Task Pilot Logo" />
			<span class="self-center text-3xl font-semibold whitespace-nowrap text-primary">Task Pilot</span>
		</a>
		{{-- Dropdown Menu --}}
		<x-utils.dropdown-button>
			<x-slot name="icon">
				<img src="{{ asset('images/avatar.png') }}" alt="{{ auth()->user()->name }}" class="size-8 cursor-pointer">
			</x-slot>
				<a href="{{ route('profile.timelogs') }}" class="dropdown-button"><span>Timelogs</span></a>
		</x-utils.dropdown-button>
	</nav>
	<div class="flex flex-grow w-full overflow-y-hidden">
		{{ $slot }}
	</div>
	<x-utils.notice />
	@livewire('wire-elements-modal')
	@vite('resources/assets/js/app.js')
	@stack('javascript')
</body>
</html>
