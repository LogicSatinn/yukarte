<ul class="mt-8 space-y-2 tracking-wide">
    <li>
        <a
            href="{{ route('home') }}"
            wire:navigate.hover
            @class([
                'relative flex items-center space-x-4 rounded-xl px-4 py-3 text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-300',
                'bg-gradient-to-r from-sky-600 to-cyan-400 text-white' => request()->routeIs('home'),
            ])
        >
            <x-heroicon-s-home-modern class="-ml-1 h-6 w-6"/>

            <span class="-mr-1 font-medium">Home</span>
        </a>
    </li>

    <li>
        <a
            href="{{ route('setting') }}"
            wire:navigate.hover
            @class([
                'relative flex items-center space-x-4 rounded-xl px-4 py-3 text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-300',
                'bg-gradient-to-r from-sky-600 to-cyan-400 text-white' => request()->routeIs('setting'),
            ])
        >
            <x-heroicon-s-cog class="-ml-1 h-6 w-6"/>

            <span class="-mr-1 font-medium">Setting</span>
        </a>
    </li>
</ul>
