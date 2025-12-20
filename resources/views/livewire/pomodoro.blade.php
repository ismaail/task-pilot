<div
		x-data="pomodoroCounter"
		class="group absolute bottom-10 right-6 px-2 py-4 rounded-lg bg-gray-300 border border-gray-700">
	<p
			x-text="format()"
			class="text-6xl text-sky-700 select-none">{{ \Illuminate\Support\seconds($this->remainingSeconds - $this->elapsedSeconds)->cascade()->format('%H:%I:%S') }}</p>
			{{--class="text-6xl text-sky-700 select-none">00:00:00</p>--}}
	{{--<button
			@click="toggle"
			class="hidden group-hover:block absolute top-1/4 left-1/3 w-fit mx-auto p-4 rounded-full bg-sky-600 cursor-pointer hover:contrast-150">
		<x-icons.play x-show="null === interval" class="size-6 fill-white text-white" />
		<x-icons.pause x-show="null !== interval" class="size-6 fill-white text-white" />
	</button>--}}
</div>

@script
<script>
	const $elm = document.querySelector('div[x-data="pomodoroCounter"]');
	Livewire.on('pomodoro.started', () => Alpine.$data($elm).start());
	Livewire.on('pomodoro.stoped', () => Alpine.$data($elm).stop());

	Alpine.data('pomodoroCounter', () => {
		return {
			remainingSeconds: $wire.remainingSeconds || (25 * 60),
			elapsedSeconds: $wire.elapsedSeconds,
			startedAt: $wire.startedAt,
			interval: null,
			init() {
				if (! $wire.paused) {
					this.start();
				}
			},
			start() {
				if (this.interval) {
					return;
				}

				this.interval = setInterval(() => {
					this.remainingSeconds--;

					if (this.remainingSeconds <= 0) {
						clearInterval(this.interval);
						this.interval = null;
					}
				}, 1000);
			},
			stop() {
				if (this.interval) {
					clearInterval(this.interval);
					this.interval = null;
				}
			},
			format() {
				// Math.abs(Math.floor((new Date() - new Date(this.startedAt)) / 1000))
				return new Date((this.remainingSeconds - this.elapsedSeconds) * 1000).toISOString().substr(11, 8);
			}
		};
	});

</script>
@endscript
