<?php

namespace Database\Seeders;

use App\Models\HomeSlider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class HomeSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $texts = ['Big Sales', 'Everything You Need Is Here'];
        $images = ['home_slider1', 'home_slider2'];
        foreach(array_map(null, $texts, $images) as [$text, $image]){
            HomeSlider::factory()->create([
                'text' => $text,
                'imgpath' => $image . '.jpg'
            ]);
        }
    }
}
