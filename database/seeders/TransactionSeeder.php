<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Category;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // 🧹 Hapus data lama dan reset auto increment
        Transaction::truncate();
        DB::statement('ALTER TABLE members AUTO_INCREMENT = 1;');
        
        // Ambil semua kategori
        $categories = Category::all();
        
        // Cek kalau kategori ada
        if ($categories->isEmpty()) {
            $this->command->warn('⚠️ Tidak ada kategori ditemukan. Jalankan CategorySeeder dulu.');
            return;
        }
        
        // 🔧 Setup Faker untuk data palsu
        $faker = \Faker\Factory::create('id_ID');
        $totalTransactions = 25;
        $year = now()->year;
        
        // 🔄 Buat transaksi palsu
        for ($i = 1; $i <= $totalTransactions; $i++) {
            $category = $categories->random();

            $month = rand(1, now()->month);
            $day = rand(1, Carbon::create($year, $month)->daysInMonth);

            $date = Carbon::create($year, $month, $day);

            Transaction::create([
                'category_id' => $category->id,
                'type' => $category->type,
                'amount' => $category->type === 'income'
                    ? $faker->numberBetween(50000, 1000000)
                    : $faker->numberBetween(10000, 750000),
                'date' => $date->format('Y-m-d'),
                'reference_number' => sprintf('TRX-%s-%05d', $year, $i),
                'description' => $faker->sentence(5),
                'receipt' => null,
            ]);
        }

        $this->command->info("✅ Berhasil menambahkan {$totalTransactions} transaksi dari Januari sampai " . now()->translatedFormat('F') . '!');
    }
}