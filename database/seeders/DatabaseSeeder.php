<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            SuperAdminSeeder::class
        ]);

        $fs = new Filesystem;
        
        // Delete files - menu\<nama file>
        $except_file_names = [
            'users\1717526873leo-remini-warrior-fire-2.jpg',
            'menus\1717530719ayam goreng.jpg'
        ];
        if(!File::exists(public_path('storage/users'))){
            File::makeDirectory(public_path('storage/users'));
        } 
        $file_paths = $fs->files(public_path('storage/users'));
        foreach ($file_paths as $file_path) {
            $file_name = last(explode('/', $file_path));
            if (!in_array($file_name, $except_file_names)) {
                $fs->delete($file_path);
            }
        }
        echo "storage/users/* successfully Clean!\n";
        
        if(!File::exists(public_path('storage/menus'))){
            File::makeDirectory(public_path('storage/menus'));
        }
        $file_paths = $fs->files(public_path('storage/menus'));
        foreach ($file_paths as $file_path) {
            $file_name = last(explode('/', $file_path));
            if (!in_array($file_name, $except_file_names)) {
                $fs->delete($file_path);
            }
        }
        echo "storage/menus/* successfully Clean!\n";
        

        \App\Models\Menu::create([
            'nama' => 'Nasi Goreng',
            'gambar' => 'food.png',
            'harga' => 10000
        ]);

        \App\Models\Menu::create([
            'nama' => 'Ayam Goreng',
            'gambar' => 'storage/menus\1717530719ayam goreng.jpg',
            'harga' => 20000
        ]);

        \App\Models\Menu::create([
            'nama' => 'Bebek Goreng',
            'gambar' => 'bebek goreng.jpg',
            'harga' => 15000
        ]);

        \App\Models\Menu::create([
            'nama' => 'Kentang Goreng',
            'gambar' => 'kentang goreng.jpg',
            'harga' => 12000
        ]);

        \App\Models\Menu::create([
            'nama' => 'Pisang Goreng',
            'gambar' => 'pisang goreng.jpg',
            'harga' => 5000
        ]);
    }
}
