<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => "Admin",
            'username' => 'AdminPlanetku',
            'email' => 'AdminPlanetku@mail.com',
            'password' => Hash::make('AdminPlanetkuLagiSalto123_'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => "User1",
            'username' => "user1",
            'password' => Hash::make('user'),
            'role' => 'user'
        ]);
        Article::factory(20)->create();
    }
}


// ln -s /home/reviensm/public_html/temanbumi/storage/app/public /home/ reviensm/public_html/temanbumi/public/storage
