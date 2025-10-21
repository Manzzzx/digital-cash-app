<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // Buat Super Admin default
    $user = User::firstOrCreate([
        'email' => 'superadmin@digitalcash.app',
    ], [
        'name' => 'Super Admin',
        'password' => bcrypt('password'), // ganti sesuai kebutuhan
    ]);

    $role = Role::firstOrCreate(['name' => 'super_admin']);

    // Berikan semua permission ke super_admin
    $role->syncPermissions(Permission::all());

    $user->assignRole($role);
    
        $this->call([
        MemberSeeder::class,
    ]);
    }
}