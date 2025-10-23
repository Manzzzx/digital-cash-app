<section class="bg-gradient-to-br from-gray-900 via-gray-800 to-emerald-900 text-white py-20">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-10 mb-12">
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-6">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo Digital Cash App" class="w-12 h-12 rounded-xl shadow-lg">
                    <div>
                        <h3 class="text-2xl font-bold">Digital Cash App</h3>
                        <p class="text-gray-400 text-sm">Sistem Manajemen Keuangan</p>
                    </div>
                </div>
                <p class="text-gray-300 leading-relaxed mb-6 max-w-md">
                    Platform modern untuk mengelola keuangan RT/RW dengan transparansi penuh dan teknologi terdepan. 
                    Membangun kepercayaan melalui transparansi dan akuntabilitas digital.
                </p>
                <div class="flex space-x-4">
                    @php
                        $socialIcons = [
                            [
                                'href' => 'https://facebook.com',
                                'svg' => 'M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 5.005 3.657 9.128 8.438 9.878v-6.993H8.077V12h2.361V9.797c0-2.337 1.393-3.633 3.522-3.633.998 0 2.042.177 2.042.177v2.247h-1.151c-1.136 0-1.489.707-1.489 1.43V12h2.533l-.405 2.885h-2.128v6.993C18.343 21.128 22 17.005 22 12z',
                                'label' => 'Facebook',
                            ],
                            [
                                'href' => 'https://instagram.com',
                                'svg' => 'M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.758 0 5-2.243 5-5V7c0-2.757-2.242-5-5-5H7zm0 2h10c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.653 0-3-1.346-3-3V7c0-1.654 1.347-3 3-3zm5 3.5A4.505 4.505 0 007.5 12 4.505 4.505 0 0012 16.5 4.505 4.505 0 0016.5 12 4.505 4.505 0 0012 7.5zm0 2A2.503 2.503 0 0114.5 12 2.503 2.503 0 0112 14.5 2.503 2.503 0 019.5 12 2.503 2.503 0 0112 9.5zM17 6a1 1 0 100 2 1 1 0 000-2z',
                                'label' => 'Instagram',
                            ],
                            [
                                'href' => 'https://twitter.com',
                                'svg' => 'M23.954 4.569a10 10 0 01-2.825.775A4.932 4.932 0 0023.337 3.1a9.864 9.864 0 01-3.127 1.184A4.92 4.92 0 0016.616 3c-2.73 0-4.943 2.214-4.943 4.943 0 .39.045.765.127 1.126A13.978 13.978 0 013.15 4.157a4.92 4.92 0 001.523 6.573 4.903 4.903 0 01-2.23-.616v.06c0 2.385 1.693 4.373 3.946 4.827a4.935 4.935 0 01-2.224.085 4.93 4.93 0 004.6 3.417A9.868 9.868 0 012 19.54 13.94 13.94 0 007.548 21c9.142 0 14.307-7.721 13.995-14.646a9.935 9.935 0 002.411-2.784z',
                                'label' => 'Twitter',
                            ],
                        ];
                    @endphp

                    <div class="flex space-x-4 mt-6">
                        @foreach ($socialIcons as $icon)
                            <a href="{{ $icon['href'] }}" target="_blank" rel="noopener"
                            class="w-10 h-10 bg-gray-700 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition-colors"
                            aria-label="{{ $icon['label'] }}">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="{{ $icon['svg'] }}" />
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-6">Tautan Cepat</h4>
                <ul class="space-y-3">
                    <li><a href="#features" class="text-gray-300 hover:text-emerald-400 transition-colors">Fitur</a></li>
                    <li><a href="{{ route('login') }}" class="text-gray-300 hover:text-emerald-400 transition-colors">Masuk</a></li>
                    <li><a href="{{ route('register') }}" class="text-gray-300 hover:text-emerald-400 transition-colors">Daftar</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-emerald-400 transition-colors">Bantuan</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-6">Kontak</h4>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3 text-gray-300">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>info@digitalcash.com</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-300">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>+62 123 456 7890</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-300">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Brebes, Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
