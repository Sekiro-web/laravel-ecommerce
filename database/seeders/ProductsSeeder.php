<?php

namespace Database\Seeders;

use App\Models\products;
use App\Models\ProductsImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Mobile', 'Laptop', 'Monitor', 'Camera'];
        $cat_id = [1, 2, 3, 4];
        foreach (array_map(null, $names, $cat_id) as [$name, $id]) {
            for ($i = 1; $i <= 10; $i++) {
                $product = products::factory()->create([
                    'name'        => $name . $i,
                    'description' => fake()->text(),
                    'price'       => rand(100, 2000),
                    'quantity'    => rand(5, 30),
                    'category_id' => $id
                ]);
                
                for ($img = 1; $img <= 3; $img++) {
                    ProductsImages::create([
                        'name'       => 'assets/img/' . $name . '.jpg',
                        'products_id' => $product->id
                    ]);
                }
            }
        }
    }
}
