<header class="fixed top-0 left-0 right-0 z-50 backdrop-blur-xl bg-white/60 dark:bg-gray-900/60 border-b border-gray-200/10 transition-all duration-300">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-10 h-10">
            <span class="text-lg font-bold gradient-text">Digital Cash App</span>
        </div>
        <nav class="flex items-center gap-6 text-sm font-medium">
            <a href="{{ route('login') }}"
                class="px-4 py-2 rounded-lg bg-emerald-500 text-white hover:bg-emerald-600 transition-all duration-300">
                Masuk
            </a>
            <a href="{{ route('register') }}"
                class="px-4 py-2 rounded-lg border border-emerald-500 text-emerald-500 hover:bg-emerald-500 hover:text-white transition-all duration-300">
                Daftar
            </a>
        </nav>
    </div>
</header>
