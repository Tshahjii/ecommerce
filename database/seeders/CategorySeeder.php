<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['categories' => 'All', 'slug' => 'all', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Bestsellers', 'slug' => 'bestsellers', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Latest', 'slug' => 'latest', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => "Today's Deals", 'slug' => 'todays-deals', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Collections', 'slug' => 'collections', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Personal Care', 'slug' => 'personal-care', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Electronics', 'slug' => 'electronics', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Gifts & Toys', 'slug' => 'gifts-toys', 'parent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Electronics & Gadgets', 'slug' => 'electronics-gadgets', 'parent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Fashion & Accessories', 'slug' => 'fashion-accessories', 'parent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Bags & Shoes', 'slug' => 'bags-shoes', 'parent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Optimum Electronics', 'slug' => 'optimum-electronics', 'parent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Health & Bueaty', 'slug' => 'health-bueaty', 'parent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Home & Lights', 'slug' => 'home-lights', 'parent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['categories' => 'Industrial Parts', 'slug' => 'industrial-parts', 'parent_id' => 1, 'created_at' => now(), 'updated_at' => now()],

        ];
        Category::insert($categories);
    }
}
