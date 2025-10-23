<x-filament-panels::page>
    {{-- FILTER --}}
    <x-filament::card class="bg-gray-900/30 dark:bg-gray-800/40 border-gray-700">
        <form wire:submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div class="col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{ $this->form }}
                </div>

                <div class="flex justify-start md:justify-end gap-2 mt-3 md:mt-0">
                    <x-filament::button type="submit" color="primary" icon="heroicon-o-magnifying-glass">
                        Tampilkan
                    </x-filament::button>
                </div>
            </div>
        </form>
    </x-filament::card>

    {{-- SUMMARY --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">
        <x-filament::card class="bg-gradient-to-br from-emerald-500/10 to-emerald-900/10 border-emerald-600/20">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-400">Total Pemasukan</p>
                    <p class="text-3xl font-bold text-emerald-400 mt-1">
                        Rp {{ number_format($total_income, 0, ',', '.') }}
                    </p>
                </div>
                <x-filament::icon icon="heroicon-o-banknotes" class="w-10 h-10 text-emerald-400/60" />
            </div>
        </x-filament::card>

        <x-filament::card class="bg-gradient-to-br from-rose-500/10 to-rose-900/10 border-rose-600/20">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-400">Total Pengeluaran</p>
                    <p class="text-3xl font-bold text-rose-400 mt-1">
                        Rp {{ number_format($total_expense, 0, ',', '.') }}
                    </p>
                </div>
                <x-filament::icon icon="heroicon-o-arrow-trending-down" class="w-10 h-10 text-rose-400/60" />
            </div>
        </x-filament::card>

        <x-filament::card class="bg-gradient-to-br from-sky-500/10 to-indigo-900/10 border-sky-600/20">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-400">Total Transaksi</p>
                    <p class="text-3xl font-bold text-sky-400 mt-1">{{ $total_transactions }}</p>
                </div>
                <x-filament::icon icon="heroicon-o-clipboard-document-list" class="w-10 h-10 text-sky-400/60" />
            </div>
        </x-filament::card>
    </div>

    {{-- TABLE --}}
    <x-filament::card class="mt-6 bg-gray-900/30 dark:bg-gray-800/40 border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700 text-sm">
                <thead class="bg-gray-800 text-gray-200 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                        <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                        <th class="px-4 py-3 text-left font-semibold">Deskripsi</th>
                        <th class="px-4 py-3 text-left font-semibold">Tipe</th>
                        <th class="px-4 py-3 text-right font-semibold">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700 text-gray-300">
                    @forelse ($transactions as $t)
                        <tr class="hover:bg-gray-800/60 transition-colors">
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($t->date)->format('d M Y') }}</td>
                            <td class="px-4 py-3">{{ $t->category->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $t->description }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-lg font-medium {{ $t->type === 'income' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-rose-500/20 text-rose-400' }}">
                                    {{ ucfirst($t->type) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right font-semibold">
                                Rp {{ number_format($t->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500 italic">
                                Tidak ada data transaksi dalam periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-filament::card>
</x-filament-panels::page>
