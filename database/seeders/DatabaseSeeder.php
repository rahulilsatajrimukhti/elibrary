<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();        

        UserLevel::create([
            'name' => 'Programmer',
        ]);

        UserLevel::create([
            'name' => 'Staff Perpustakaan',
        ]);

        User::create([
            'name' => 'Rahul Ilsa Tajri Mukhti',
            'email' => 'cengrahul00@gmail.com',
            'password' => Hash::make('PASS1234'),
            'user_level_id' => 1,
        ]);

        User::create([
            'name' => 'Yasmi Dyanti Maghfira',
            'email' => 'yasmidyanti@gmail.com',
            'password' => Hash::make('PASS1234'),
            'user_level_id' => 2,
        ]);

        Menu::create([
            'name' => 'User',
            'route' => 'users.index',
            'icon' => 'fas fa-fw fa-user',
            'parent_id' => null,
            'order' => '1',
        ]);

        Menu::create([
            'name' => 'User Level',
            'route' => 'user-levels.index',
            'icon' => 'fas fa-fw fa-user-tag',
            'parent_id' => null,
            'order' => '2',
        ]);

        Menu::create([
            'name' => 'Menu',
            'route' => 'menus.index',
            'icon' => 'fas fa-fw fa-list',
            'parent_id' => null,
            'order' => '3',
        ]);
    }
}
