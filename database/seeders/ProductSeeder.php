<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            'name' => 'essential',
            'description' => 'includes essential needs',
            'price' => '450000',
            'stock' => '100',
            'free' => 'free reusable bag',
        ]);

        Product::insert([
            'name' => 'standard',
            'description' => 'additional important item',
            'price' => '670000',
            'stock' => '100',
            'free' => 'free hand sanitizer',
        ]);

        Product::insert([
            'name' => 'deluxe',
            'description' => 'various items for wider',
            'price' => '790000',
            'stock' => '100',
            'free' => 'free set of face masks',
        ]);

        Product::insert([
            'name' => 'gold',
            'description' => 'high-quality and diserve items',
            'price' => '995000',
            'stock' => '100',
            'free' => 'free personal hygiene kit',
        ]);
    }
}
