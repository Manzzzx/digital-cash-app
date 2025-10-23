<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-900 via-emerald-800 to-teal-900"></div>
    <img src="{{ asset('images/balaidesa.jpg') }}" alt="Background"
        class="absolute inset-0 w-full h-full object-cover object-center opacity-20">
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

    <div class="absolute top-20 left-10 w-20 h-20 bg-emerald-500/20 rounded-full blur-xl animate-float"></div>
    <div class="absolute top-40 right-20 w-32 h-32 bg-teal-500/20 rounded-full blur-xl animate-float"
        style="animation-delay: 2s;"></div>
    <div class="absolute bottom-40 left-1/4 w-16 h-16 bg-emerald-400/30 rounded-full blur-lg animate-float"
        style="animation-delay: 4s;"></div>

    <div class="relative z-10 px-6 max-w-5xl text-center text-white animate-fade-in">
        <div
            class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-8">
            <span class="w-2 h-2 bg-emerald-400 rounded-full mr-2 animate-pulse"></span>
            <span class="text-sm font-medium">Sistem Terpercaya & Transparan</span>
        </div>

        <h1 class="text-6xl md:text-7xl font-bold mb-6 tracking-tight leading-tight">
            <span class="block">Transparansi</span>
            <span class="bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">
                Keuangan Warga
            </span>
        </h1>

        <p class="text-xl md:text-2xl text-gray-200 mb-12 leading-relaxed max-w-3xl mx-auto">
            Kelola pemasukan dan pengeluaran kas RT/RW secara
            <span class="font-semibold text-emerald-300">modern</span>,
            <span class="font-semibold text-emerald-300">transparan</span>,
            dan <span class="font-semibold text-emerald-300">real-time</span>
            dengan teknologi terdepan.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
            <a href="{{ route('login') }}"
                class="group px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 rounded-2xl text-lg font-semibold text-white shadow-2xl hover:shadow-emerald-500/25 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                <span class="flex items-center gap-3">
                    <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Masuk sebagai Warga
                </span>
            </a>

            <a href="#features"
                class="px-8 py-4 rounded-2xl text-lg font-semibold text-white border-2 border-white/30 hover:border-white/60 hover:bg-white/10 transition-all duration-300 backdrop-blur-sm">
                Pelajari Lebih Lanjut
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            <div class="text-center">
                <div class="text-3xl font-bold text-emerald-400 mb-2">100%</div>
                <div class="text-gray-300">Transparansi</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-emerald-400 mb-2">Real-time</div>
                <div class="text-gray-300">Laporan</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-emerald-400 mb-2">24/7</div>
                <div class="text-gray-300">Akses</div>
            </div>
        </div>
    </div>
</section>
