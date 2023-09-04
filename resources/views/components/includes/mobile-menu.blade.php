<div class="sticky top-0 h-16 border-b bg-white dark:bg-gray-800 dark:border-gray-700 lg:py-3">
    <div x-data="{ slideOverOpen: false }" class="flex items-center justify-start space-x-4 px-6 2xl:container">
        <button @click="slideOverOpen=true"
                class="-mr-2 h-16 w-12 border-r lg:hidden dark:border-gray-700 dark:text-gray-300">
            <x-heroicon-s-bars-3-center-left class="w-6 h-6"/>
        </button>
        <h5 class="text-2xl font-medium text-gray-600 lg:block dark:text-white">@yield('title')</h5>

        <template x-teleport="body">
            <div
                x-show="slideOverOpen"
                @keydown.window.escape="slideOverOpen=false"
                class="relative z-[99]">
                <div x-show="slideOverOpen" x-transition.opacity.duration.600ms @click="slideOverOpen = false"
                     class="fixed inset-0 bg-black bg-opacity-10"></div>
                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="fixed inset-y-0 left-0 flex max-w-full pl-10">
                            <div
                                x-show="slideOverOpen"
                                @click.away="slideOverOpen = false"
                                x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                                x-transition:enter-start="translate-x-full"
                                x-transition:enter-end="translate-x-0"
                                x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                                x-transition:leave-start="translate-x-0"
                                x-transition:leave-end="translate-x-full"
                                class="w-screen max-w-md">
                                <div
                                    class="flex flex-col h-full py-5 overflow-y-scroll bg-white dark:bg-gray-800 border-l shadow-lg border-neutral-100/70">
                                    <div class="px-4 sm:px-5">
                                        <div class="flex items-start justify-between pb-1">
                                            <div class="flex items-center h-auto">
                                                <div>
                                                    <img
                                                        src="https://avatars.githubusercontent.com/u/69092766?v=4"
                                                        alt=""
                                                        class="h-8 w-8 rounded-full object-cover"
                                                    />
                                                </div>
                                                <button @click="slideOverOpen=false"
                                                        class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-4 mr-5 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 text-neutral-600 dark:text-neutral-300">
                                                    <x-heroicon-s-x-mark class="w-4 h-4"/>

                                                    <span>Close</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative flex-1 px-4 mt-5 sm:px-5">
                                        <div class="absolute inset-0 px-4 sm:px-5">
                                            <div class="relative h-full overflow-hidden">
                                                <div>
                                                    <x-includes.menu/>

                                                    <div x-data="toggleTheme"
                                                         class="-mx-6 flex flex-col items-start justify-start border-t px-6 pt-4 dark:border-gray-700">
                                                        <button x-show="theme === 'light'" @click="toggle"
                                                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-600 dark:text-gray-300">
                                                            <x-heroicon-s-moon x-show="theme === 'light'"
                                                                               class="w-6 h-6"/>

                                                            <span
                                                                class="group-hover:text-gray-700 dark:group-hover:text-white">Toggle Theme</span>
                                                        </button>

                                                        <button x-show="theme === 'dark'" @click="toggle"
                                                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-600 dark:text-gray-300">
                                                            <x-heroicon-s-sun x-show="theme === 'dark'"
                                                                              class="w-6 h-6"/>

                                                            <span
                                                                class="group-hover:text-gray-700 dark:group-hover:text-white">Toggle Theme</span>
                                                        </button>

                                                        <button
                                                            class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-600 dark:text-gray-300">
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="h-6 w-6"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke="currentColor"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                                                />
                                                            </svg>
                                                            <span
                                                                class="group-hover:text-gray-700 dark:group-hover:text-white">Logout</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
