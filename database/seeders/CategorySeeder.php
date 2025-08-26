<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Mobile', 'Laptop', 'Monitor', 'Camera'];
        foreach ($names as $name) {
            Category::factory()->create([
                'name' => $name,
                'imgpath' => 'assets/img/' . $name . '.jpg'
            ]);
        }
    }
}
