<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);

        $this->call(CategorySeeder::class);

        $this->call(productsSeeder::class);

        $this->call(HomeSliderSeeder::class);

        $this->call(FeedbackSeeder::class);
    }
}
