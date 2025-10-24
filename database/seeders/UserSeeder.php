<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🧹 Bersihkan data user lama (biar ID mulai dari 1 lagi)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 👑 Buat akun Super Admin
        $user = User::firstOrCreate(
            ['email' => 'superadmin@digitalcash.app'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        // 🔍 Cari role super_admin dari RoleSeeder
        $role = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);

        // 🏆 Pastikan role punya semua permission
        $role->syncPermissions(Permission::all());

        // 🔗 Assign role ke Super Admin
        $user->assignRole($role);

        $this->command->info('✅ Super Admin dibuat & sudah memiliki semua izin.');
    }
}