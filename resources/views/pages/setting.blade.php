@section('title', __('Setting'))

<section class="space-y-4">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Setting') }}
        </h2>
    </x-slot>

    <section
        class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <div class="flex flex-row justify-between items-center">
            <header class="flex items-center gap-x-3 overflow-hidden px-6 py-4">
                <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    Configurations
                </h3>
            </header>

            <div class="gap-x-3 px-6 py-4">
                {{ $this->updateConfigurationsAction }}
            </div>
        </div>


        <div class="border-t border-gray-200 dark:border-white/10">
            <div class="p-6">
                <dl>
                    <div style="--cols-default: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(2, minmax(0, 1fr));"
                         class="grid grid-cols-[--cols-default] lg:grid-cols-[--cols-lg] fi-in-component-ctn gap-6">
                        <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                            <div>
                                <div class="grid gap-y-2">
                                    <div class="flex items-center justify-between gap-x-3">
                                        <dt class="inline-flex items-center gap-x-3">
                                            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Weight Unit</span>
                                        </dt>
                                    </div>

                                    <div class="grid gap-y-2">
                                        <dd>
                                            <div class="min-w-0 flex-1">
                                                <div
                                                    class="fi-in-text-item inline-flex items-center gap-1.5 text-sm leading-6 text-gray-950 dark:text-white">
                                                    <div>{{ $weightUnit ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </dd>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                            <div>
                                <div class="grid gap-y-2">
                                    <div class="flex items-center justify-between gap-x-3">
                                        <dt class="inline-flex items-center gap-x-3">
                                            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Training Max Percentage</span>
                                        </dt>
                                    </div>

                                    <div class="grid gap-y-2">
                                        <dd>
                                            <div class="min-w-0 flex-1">
                                                <div
                                                    class="fi-in-text-item inline-flex items-center gap-1.5 text-sm leading-6 text-gray-950 dark:text-white">
                                                    <div>{{ $trainingMaxPercentage ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </dd>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </dl>
            </div>
        </div>
    </section>

    <section
        class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <div class="flex flex-row justify-between items-center">
            <header class="flex items-center gap-x-3 overflow-hidden px-6 py-4">
                <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    One Rep Maxes
                </h3>
            </header>

            <div class="px-6 py-4">
                {{ $this->addOrUpdateOneRepMaxesAction }}
            </div>
        </div>


        @forelse($oneRepMaxes as $mainLift => $value)
            <div class="border-t border-gray-200 dark:border-white/10">
                <h5 class="pt-2 px-4 text-sm font-semibold leading-6 text-gray-950 dark:text-white">
                    {{ $mainLift }}
                </h5>

                <div class="p-4 space-y-2">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div
                            class="relative flex items-center space-x-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-6 py-5 shadow-sm hover:border-gray-400 dark:hover:border-gray-500">
                            <div class="min-w-0 flex-1">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $value['one_rep_max'] }}</p>
                                <p class="truncate text-sm text-gray-500 dark:text-gray-400">One Rep Max</p>
                            </div>
                        </div>

                        <div
                            class="relative flex items-center space-x-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-6 py-5 shadow-sm hover:border-gray-400 dark:hover:border-gray-500">
                            <div class="min-w-0 flex-1">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $value['training_max'] }}</p>
                                    <p class="truncate text-sm text-gray-500 dark:text-gray-400">Training Max</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-6 text-center">
                <x-heroicon-s-x-circle class="mx-auto h-12 w-12 text-gray-400"/>

                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">No Rep Maxes added</h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by adding the rep maxes.</p>
                <div class="mt-6">
                    {{ $this->addOneRepMaxesAction }}
                </div>
            </div>
        @endforelse
    </section>

    <section
        class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <header class="flex items-center gap-x-3 overflow-hidden px-6 py-4">
            <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                Program ( Read-Only )
            </h3>
        </header>

        @forelse($program as $week => $sets)
            <div class="border-t border-gray-200 dark:border-white/10">
                <h5 class="pt-2 px-4 text-sm font-semibold leading-6 text-gray-950 dark:text-white">
                    {{ str($week)->title()->replace('_', ' ') }}
                </h5>

                @foreach($sets as $set => $value)
                    <div class="p-4 space-y-2">
                        <h5 class="text-sm font-semibold leading-6 text-gray-950 dark:text-white">
                            {{ str($set)->title()->replace('_', ' ') }}
                        </h5>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div
                                class="relative flex items-center space-x-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-6 py-5 shadow-sm hover:border-gray-400 dark:hover:border-gray-500">
                                <div class="min-w-0 flex-1">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $value['percentage_based_on_training_max'] }}</p>
                                    <p class="truncate text-sm text-gray-500 dark:text-gray-400">Percentage based on
                                        Training Max</p>
                                </div>
                            </div>

                            <div
                                class="relative flex items-center space-x-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-6 py-5 shadow-sm hover:border-gray-400 dark:hover:border-gray-500">
                                <div class="min-w-0 flex-1">
                                    <a href="#" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $value['reps'] }}</p>
                                        <p class="truncate text-sm text-gray-500 dark:text-gray-400">Reps</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @empty
            <div class="p-6 text-center">
                <x-heroicon-s-x-circle class="mx-auto h-12 w-12 text-gray-400"/>

                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">No Program Loaded</h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Please check if the program.yml exists and is being loaded.
                </p>
            </div>
        @endforelse
    </section>

    <x-filament-actions::modals/>
</section>
