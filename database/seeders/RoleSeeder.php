<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🧹 Nonaktifkan foreign key constraint sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 🔁 Kosongkan semua tabel permission & relasi
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();

        // ✅ Aktifkan kembali foreign key constraint
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 🌟 Buat role super_admin
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);

        // 🏆 Beri semua permission ke super_admin
        $superAdminRole->syncPermissions(Permission::all());

        $this->command->info('✅ Role Super Admin berhasil dibuat dengan semua permission.');
    }
}