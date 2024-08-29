<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Task Pilot</title>
	@livewireStyles
	@vite('resources/assets/css/app.css')
</head>
<body>
	<nav class="border-gray-200">
		<div class="flex flex-wrap items-start justify-between max-w-screen-xl mx-auto p-4">
			<a href="#" class="flex items-center space-x-2">
				<img src="{{ asset('images/logo-m.jpg') }}" class="h-8" alt="Task Pilot Logo" />
				<span class="self-center text-3xl font-semibold whitespace-nowrap text-primary">Task Pilot</span>
			</a>
		</div>
	</nav>
	<div class="flex flex-grow max-w-screen-xl overflow-y-hidden">
		{{ $slot }}
	</div>
</body>
</html>
