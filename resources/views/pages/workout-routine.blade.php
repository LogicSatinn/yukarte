@section('title', __('Your Workout Routine'))

<section>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Workout Routine') }}
        </h2>
    </x-slot>

    <section
        class="rounded-lg bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        @forelse($routine as $day => $workouts)
        @empty
            <x-utilities.empty-state
                message="No workout routine added"
                description="Get started by adding the workout routine."
            >
                {{ $this->addWorkoutRoutineAction() }}
            </x-utilities.empty-state>
        @endforelse
    </section>

    <x-filament-actions::modals />
</section>
