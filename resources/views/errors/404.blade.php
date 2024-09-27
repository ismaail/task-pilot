<x-layouts.app>
	<x-slot name="title">Error 404: Page Not Found</x-slot>
	<main class="w-full flex flex-col items-center justify-center space-y-6 md:gap-y-10 text-white">
		<h1 class="text-3xl xs:text-2xl font-semibold">@lang('Error - Page Not Found')</h1>
		<p class="text-lg text-center">Sorry, the page you're looking for not found !</p>
		<a href="{{ route('home') }}" class="p-4 border border-primary hover:bg-white transition hover:text-secondary text-lg font-semibold rounded">Back to Homepage</a>
	</main>
</x-layouts.app>
