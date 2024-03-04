<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, Category, HashTag, Article,ArticleHashTag};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // User::factory(30)->create();
        // Category::factory(30)->create();
        // HashTag::factory(30)->create();
        // Article::factory(30)->create();
        ArticleHashTag::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => Hash::make('password'),
        // ]);
    }
}
