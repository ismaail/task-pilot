<section class="self-center sm:mx-auto sm:w-full sm:max-w-sm px-8 py-4 border-2 border-black/10 bg-gray-300 rounded-lg">
	<a href="{{ route('home') }}" class="flex mb-6 mx-auto items-center justify-center space-x-2">
		<picture>
			<source srcset="{{ asset('images/logo-dark.png') }}" class="h-8" w="48" height="32" media="(prefers-color-scheme:dark)">
			<img src="{{ asset('images/logo.png') }}" alt="{{ config('app.title') }}" class="h-8" w="48" height="32">
		</picture>
		<span class="self-center text-3xl font-semibold whitespace-nowrap text-primary">Task Pilot</span>
	</a>
	<div x-show="$wire.failedAttempt" class="px-4 py-2 mb-4 bg-danger rounded-lg border-2 border-white text-text">
		Wrong Credentials
	</div>
	<form
			wire:submit.prevent="login"
			x-on:submit.prevent="$wire.failedAttempt=false"
			method="post"
			class="space-y-6">
		<div>
			<label for="email" class="block text-sm font-medium leading-6 text-text">Email address</label>
			<div class="mt-2">
				<input wire:model="form.email" id="email" name="email" type="email" autocomplete="email" required class="form-input w-full">
				@error('form.email')<span class="text-xs text-danger">{{ $message }}</span>@enderror
			</div>
		</div>
		<div>
			<div class="flex items-center justify-between">
				<label for="password" class="block text-sm font-medium leading-6 text-text">Password</label>
				<a href="#" class="font-semibold text-text text-xs hover:text-emerald-500">Forgot password ?</a>
			</div>
			<div class="mt-2">
				<input wire:model="form.password" id="password" name="password" type="password" autocomplete="current-password" required class="form-input w-full">
				@error('form.password')<span class="text-xs text-danger">{{ $message }}</span>@enderror
			</div>
		</div>
		<div class="flex items-center justify-between gap-x-3">
			<label class="inline-flex items-center gap-x-3" for="data.remember">
				<input type="checkbox" id="data.remember" wire:loading.attr="disabled" wire:model="form.remember">
				<span class="text-sm text-text">@lang('Remember me')</span>
			</label>
		</div>
		<div>
			<button type="submit" class="flex w-full justify-center rounded-md bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-text shadow-sm hover:contrast-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 border-2 border-white cursor-pointer">
				<span wire:loading.class="hidden">@lang('Sign in')</span>
				<span wire:loading><svg class="inline w-5 h-5 text-text animate-spin" aria-hidden="true" role="status" viewBox="0 0 100 101" fill="#e5e7eb" xmlns="http://www.w3.org/2000/svg">
					<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentFill"></path>
					<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"></path>
				</svg></span>
			</button>
		</div>
	</form>
</section>
