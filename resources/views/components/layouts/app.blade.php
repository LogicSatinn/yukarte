<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name') }}</title>

    <style>
        [x-cloak=''],
        [x-cloak='x-cloak'],
        [x-cloak='1'] {
            display: none !important;
        }

        @media (max-width: 1023px) {
            [x-cloak='-lg'] {
                display: none !important;
            }
        }

        @media (min-width: 1024px) {
            [x-cloak='lg'] {
                display: none !important;
            }
        }
    </style>
    @livewireStyles
    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 dark:bg-gray-900">
<aside
    class="fixed top-0 z-10 ml-[-100%] flex h-screen w-full flex-col justify-between border-r bg-white px-6 pb-3 transition duration-300 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[15%] dark:bg-gray-800 dark:border-gray-700"
>
    <div>
        <div class="-mx-6 px-6 py-4">
                <span class="text-gray-800 dark:text-white/90 text-lg font-bold">
                    {{ config('app.name') }}
                </span>
        </div>

        <div class="mt-8 flex flex-col items-center space-y-2">
            <img
                src="https://avatars.githubusercontent.com/u/69092766?v=4"
                alt=""
                class="m-auto h-10 w-10 rounded-full object-cover lg:h-28 lg:w-28"
            />

            <h5 class="mt-4 hidden text-xl font-semibold text-gray-600 lg:block dark:text-gray-300">Calvin Jackson</h5>

            <div x-data="toggleTheme" class="flex items-center justify-center space-x-2">
                <button
                    type="button"
                    @click="toggle"
                    class="relative inline-flex h-8 py-0.5 bg-transparent cursor-pointer"
                    x-cloak>
                    <label
                        :id="$id('switch')"
                        :class="{ 'text-gray-300': theme === 'dark', 'text-gray-700': theme === 'light' }"
                        class="text-sm select-none cursor-pointer"
                        x-cloak>
                        <x-heroicon-s-moon x-show="theme === 'light'" class="w-6 h-6"/>
                        <x-heroicon-s-sun x-show="theme === 'dark'" class="w-6 h-6"/>
                    </label>
                </button>

            </div>


        </div>

        <x-includes.menu/>
    </div>

    <div class="-mx-6 flex items-center justify-between border-t px-6 pt-4 dark:border-gray-700">
        <button class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-600 dark:text-gray-300">
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
            <span class="group-hover:text-gray-700 dark:group-hover:text-white">Logout</span>
        </button>
    </div>
</aside>

<main class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
    <x-includes.mobile-menu/>

    <div class="px-6 pt-6 2xl:container">
        {{ $slot }}
    </div>
</main>

@livewireScripts
@filamentScripts
@vite('resources/js/app.js')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('toggleTheme', () => ({
            theme: '',
            init() {
                if (window.matchMedia('(prefers-color-scheme: dark)') && localStorage.getItem('theme') === 'dark') {
                    this.theme = 'dark';
                } else {
                    this.theme = 'light';
                }
                localStorage.theme = this.theme;
                this.applyTheme()
            },
            toggle() {
                this.theme = this.theme === 'light' ? 'dark' : 'light';
                localStorage.theme = this.theme;
                this.applyTheme()
            },
            async applyTheme() {
                await this.$nextTick();
                if (localStorage.theme === 'dark') {
                    document.documentElement.classList.add('dark')
                } else {
                    document.documentElement.classList.remove('dark')
                }
            }
        }))
    })
</script>
</body>
</html>
