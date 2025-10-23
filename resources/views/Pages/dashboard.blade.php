@extends('layouts.main')

@section('content')
<div class="container mx-auto mt-20">
    <h1 class="text-3xl font-bold mb-6">Dashboard Warga</h1>
    <div class="grid md:grid-cols-3 gap-6">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow text-center">
            <h2 class="text-xl font-semibold text-emerald-500">Pemasukan</h2>
            <p class="text-2xl font-bold mt-2">Rp 2.500.000</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow text-center">
            <h2 class="text-xl font-semibold text-rose-500">Pengeluaran</h2>
            <p class="text-2xl font-bold mt-2">Rp 1.200.000</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow text-center">
            <h2 class="text-xl font-semibold text-indigo-500">Saldo Kas</h2>
            <p class="text-2xl font-bold mt-2">Rp 1.300.000</p>
        </div>
    </div>
</div>
@endsection
