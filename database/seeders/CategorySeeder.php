<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🔒 Nonaktifkan foreign key & reset ID
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1;');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 📅 Base date (biar keliatan beda tiap kategori)
        $baseDate = Carbon::create(2025, 1, 1);

        // 📦 Data kategori
        $categories = [
            [
                'name' => 'Dana Sosial',
                'type' => 'income',
                'image' => 'categories/donation.png',
                'description' => 'Dana yang dikumpulkan untuk kegiatan sosial warga.',
            ],
            [
                'name' => 'Operasional Kegiatan',
                'type' => 'expense',
                'image' => 'categories/calendar.png',
                'description' => 'Pengeluaran untuk acara atau kegiatan lingkungan.',
            ],
            [
                'name' => 'Iuran Warga',
                'type' => 'income',
                'image' => 'categories/salary.png',
                'description' => 'Pemasukan rutin dari iuran bulanan warga.',
            ],
            [
                'name' => 'Perawatan Fasilitas',
                'type' => 'expense',
                'image' => 'categories/tool-box.png',
                'description' => 'Pengeluaran untuk pemeliharaan fasilitas umum.',
            ],
            [
                'name' => 'Sumbangan Sponsor',
                'type' => 'income',
                'image' => 'categories/giftbox.png',
                'description' => 'Donasi dari sponsor atau pihak ketiga.',
            ],
            [
                'name' => 'Bantuan Pemerintah',
                'type' => 'income',
                'image' => 'categories/goverment.png',
                'description' => 'Dana bantuan dari lembaga pemerintah.',
            ],
            [
                'name' => 'Donasi & Bantuan',
                'type' => 'expense',
                'image' => 'categories/healthcare.png',
                'description' => 'Pengeluaran untuk bantuan sosial kepada warga.',
            ],
            [
                'name' => 'Administrasi & ATK',
                'type' => 'expense',
                'image' => 'categories/stationery.png',
                'description' => 'Biaya administrasi dan perlengkapan kantor.',
            ],
            [
                'name' => 'Kas RT/RW',
                'type' => 'income',
                'image' => 'categories/diversity.png',
                'description' => 'Kas utama RT/RW dari berbagai sumber pemasukan.',
            ],
            [
                'name' => 'Keamanan & Kebersihan Lingkungan',
                'type' => 'expense',
                'image' => 'categories/insurance.png',
                'description' => 'Pengeluaran untuk keamanan dan kebersihan lingkungan.',
            ],
        ];

        foreach ($categories as $index => &$category) {
            $category['created_at'] = $baseDate->copy()->addDays($index * 5); // beda 5 hari tiap kategori
            $category['updated_at'] = $category['created_at'];
        }

        // 🚀 Masukkan ke database
        Category::insert($categories);

        $this->command->info('✅ CategorySeeder berhasil dijalankan');
    }
}