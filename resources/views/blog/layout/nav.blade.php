<nav class="border-b bg-white relative z-50" x-data="{ open: false }">
    <div class="max-w-[1200px] mx-auto px-4 py-3 flex items-center justify-between gap-4">
        <!-- Logo & Search (Desktop) -->
        <div class="flex items-center gap-4 md:gap-6 flex-1">
            <a href="{{ route('blog') }}" class="flex items-center gap-2 shrink-0">
                <img src="{{ asset('images/blogify.png') }}" alt="{{ config('app.name') }}" class="w-12 h-12 md:w-14 md:h-14 object-contain">
                <h3 class="font-bold text-xl md:text-2xl">{{ config('app.name') }}</h3>
            </a>

            <form method="GET" action="{{ route('blog') }}" class="hidden md:block flex-1 max-w-md">
                <input type="search" placeholder="{{ __('Search articles...') }}"
                    class="px-3 py-2 rounded border border-gray-200 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    name="search" value="{{ request('search') }}">
            </form>
        </div>

        <!-- Desktop Navigation Links -->
        <div class="hidden md:flex items-center gap-2">
            <a href="{{ route('create-article') }}" class="hover:bg-gray-100 rounded-full px-4 py-2 transition-colors font-medium text-sm">{{ __('Write Article') }}</a>
            <a href="{{ route('profile.index') }}" class="hover:bg-gray-100 rounded-full px-4 py-2 transition-colors font-medium text-sm">{{ __('Profile') }}</a>
            <form action="{{ route('logout') }}" method="post" class="inline">
                @csrf
                <button type="submit" class="hover:bg-red-50 text-red-600 rounded-full px-4 py-2 transition-colors font-medium text-sm">{{ __('Logout') }}</button>
            </form>
        </div>

        <!-- Mobile Hamburger Toggle Button -->
        <div class="md:hidden flex items-center">
            <button @click="open = !open" type="button" class="p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none" aria-label="Toggle navigation">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="open" x-cloak x-transition class="md:hidden border-t border-gray-100 px-4 pt-3 pb-4 space-y-3 bg-white">
        <form method="GET" action="{{ route('blog') }}" class="w-full">
            <input type="search" placeholder="{{ __('Search articles...') }}"
                class="px-3 py-2 rounded border border-gray-200 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                name="search" value="{{ request('search') }}">
        </form>

        <div class="flex flex-col space-y-1 pt-1">
            <a href="{{ route('create-article') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium text-gray-700">{{ __('Write Article') }}</a>
            <a href="{{ route('profile.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium text-gray-700">{{ __('Profile') }}</a>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-red-600 hover:bg-red-50 font-medium">{{ __('Logout') }}</button>
            </form>
        </div>
    </div>
</nav>