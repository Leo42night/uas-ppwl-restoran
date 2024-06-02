<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $pelanggan = Role::create(['name' => 'Pelanggan']);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-menu',
            'edit-menu',
            'delete-menu',
            'show-pesan'
        ]);

        $pelanggan->givePermissionTo([
            'show-pesan'
        ]);
    }
}
