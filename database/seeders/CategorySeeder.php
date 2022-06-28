<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryIds = Category::factory(15)->create()->pluck('id')->toArray();
        $products = Product::all();
        foreach ($products as $product) {
            $product->categories()->sync(array_rand(array_flip($categoryIds), rand(2, 10)));
        }
    }
}
