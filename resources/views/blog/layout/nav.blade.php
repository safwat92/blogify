<nav class="bg-blue-800 text-white">
    <div class="flex items-center max-w-[1200px] m-auto justify-between px-4">
        <a href="{{ route("blog") }}" class="flex items-center">
            <img src="{{ asset("images/blogify-white.png") }}" alt="{{ @config("app.name") }}" width="80">
            <h3 class="font-bold text-2xl pl-3">{{ @config("app.name") }}</h3>
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route("profile") }}" class="block hover:bg-white rounded-full px-4 py-1 hover:text-black transition-colors">{{ __("Profile") }}</a>
            <form action="{{ route("logout") }}" method="post">
                @csrf
                <button class="block hover:bg-red-500 rounded-full px-4 py-1 transition-colors">logout</button>
            </form>
        </div>
    </div>
</nav>