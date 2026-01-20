<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Task Pilot</title>
	@livewireStyles
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
<div class="flex flex-grow w-full overflow-y-hidden">
	{{ $slot }}
</div>
</body>
</html>
