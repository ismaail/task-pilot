<div class="w-[600px] py-1">
	<div class="flex px-2 justify-between items-center">
		<h2 class="font-semibold">Create New Task</h2>
		<button wire:click="$dispatch('closeModal')" class="fill-secondary text-white hover:fill-secondary/90 hover:text-white">
			<x-icons.circle-close class="size-8"></x-icons.circle-close>
		</button>
	</div>
	<form class="my-2 px-2 pt-2 space-y-4 border-t border-gray-300" wire:submit.prevent="create">
		<div>
			<label for="name" class="block textsm font-semibold">Name</label>
			<input type="text" id="name" wire:model="form.name" required autocomplete="name" autofocus class="block w-full mt-2 py-1 px-2 border border-gray-400 rounded-md shadow-sm outline-none focus:border-sky-500 focus:ring-sky-500">
			@error('form.name')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
		</div>
		<div>
			<label for="description" class="block textsm font-semibold">description</label>
			<textarea type="text" id="description" wire:model="form.description" rows="3" class="block w-full mt-2 py-1 px-2 border border-gray-400 rounded-md shadow-sm outline-none focus:border-sky-500 focus:ring-sky-500"></textarea>
			@error('form.description')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
		</div>
		<div class="flex justify-end">
			<button type="submit" class="floatend w-40 mr-2 px-5 py-2 rounded bg-secondary hover:bg-secondary/90 disabled:bg-gray-400 text-center font-semibold text-white tracking-wider">
				<span wire:loading.class="hidden">Create</span>
				<span wire:loading><x-icons.spinner /></span>
			</button>
		</div>
	</form>
</div>
