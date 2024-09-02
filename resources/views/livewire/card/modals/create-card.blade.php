<div class="w-[600px] py-1">
	<div class="flex px-2 justify-between items-center">
		<h2 class="font-semibold">Create New Task</h2>
		<button wire:click="$dispatch('closeModal')" class="fill-secondary text-white hover:fill-secondary/90 hover:text-white">
			<svg xmlns="http://www.w3.org/2000/svg" fill="fillColor" viewBox="0 0 25 25" stroke-width="1.5" stroke="currentColor" class="size-8">
				<path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
			</svg>
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
				<span wire:loading><svg class="inline w-5 h-5 text-white animate-spin" aria-hidden="true" role="status" viewBox="0 0 100 101" fill="#e5e7eb" xmlns="http://www.w3.org/2000/svg">
					<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentFill"></path>
					<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"></path>
				</svg></span>
			</button>
		</div>
	</form>
</div>
