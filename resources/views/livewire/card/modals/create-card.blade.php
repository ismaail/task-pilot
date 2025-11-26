<div class="w-[600px] py-1">
	<div class="flex px-2 justify-between items-center">
		<h2 class="font-semibold">@lang('Create New Task')</h2>
		<button wire:click="$dispatch('closeModal')" class="fill-secondary text-text cursor-pointer hover:contrast-75">
			<x-icons.circle-close class="size-8"></x-icons.circle-close>
		</button>
	</div>
	<form class="my-2 px-2 pt-2 space-y-4 border-t border-gray-300" wire:submit.prevent="create">
		<div>
			<label for="name" class="form-label">@lang('Name')</label>
			<input type="text" id="name" wire:model="form.name" required autocomplete="name" autofocus class="form-input w-full">
			@error('form.name')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
		</div>
		<div>
			<label for="description" class="form-label">@lang('description')</label>
			<textarea type="text" id="description" wire:model="form.description" rows="3" class="form-input w-full"></textarea>
			@error('form.description')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
		</div>
		<div class="flex justify-end">
			<button type="submit" class="btn disabled:bg-gray-300">
				<span wire:loading.class="hidden">@lang('Create')</span>
				<span wire:loading><x-icons.spinner class="size-5" /></span>
			</button>
		</div>
	</form>
</div>
