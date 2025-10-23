<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🔒 Disable foreign key checks (biar aman kalau ada relasi ke tabel lain)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 🧹 Hapus data lama dan reset auto increment
        Member::truncate();
        DB::statement('ALTER TABLE members AUTO_INCREMENT = 1;');

        // 🧩 Generate data baru dari factory
        Member::factory()->count(5)->create();

        // 🔓 Aktifkan lagi foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✅ MemberSeeder berhasil dijalankan! 5 anggota baru dibuat.');
    }
}