<?php

namespace Database\Seeders;

use App\Models\ChildCategory;
use Illuminate\Database\Seeder;

class ChildCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_child = [
            ['child_category' => 'Top Rated', 'slug' => 'top-rated', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Most Purchased', 'slug' => 'most-purchased', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Trending Products', 'slug' => 'trending-products', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Customer Favorites', 'slug' => 'customer-favorites', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now(),],

            ['child_category' => 'Kids', 'slug' => 'kids', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => "Women's", 'slug' => 'womens', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Furniture', 'slug' => 'furniture', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now(),],

            ['child_category' => 'New Arrivals', 'slug' => 'new-arrivals', 'category_id' => 4, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Just Launched', 'slug' => 'just-launched', 'category_id' => 4, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Trending Now', 'slug' => 'trending-now', 'category_id' => 4, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Recently Added', 'slug' => 'recently-added', 'category_id' => 4, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Editor Picks', 'slug' => 'editor-picks', 'category_id' => 4, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Hot This Week', 'slug' => 'hot-this-week', 'category_id' => 4, 'created_at' => now(), 'updated_at' => now(),],

            ['child_category' => 'Living Room', 'slug' => 'living-room', 'category_id' => 5, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Women', 'slug' => 'women', 'category_id' => 5, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Western Wear', 'slug' => 'western-wear', 'category_id' => 5, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Footear', 'slug' => 'footer', 'category_id' => 5, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Electronics', 'slug' => 'electronics', 'category_id' => 5, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Mobile & Accessories', 'slug' => 'mobile-&-accessories', 'category_id' => 5, 'created_at' => now(), 'updated_at' => now(),],

            ['child_category' => 'Skin Care', 'slug' => 'skin-care', 'category_id' => 6, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Hair Care', 'slug' => 'hair-care', 'category_id' => 6, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Men Grooming', 'slug' => 'men-grooming', 'category_id' => 6, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Beauty Products', 'slug' => 'beauty-products', 'category_id' => 6, 'created_at' => now(), 'updated_at' => now(),],

            ['child_category' => 'Mobiles', 'slug' => 'mobiles', 'category_id' => 7, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Laptops', 'slug' => 'laptops', 'category_id' => 7, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Smart Gadgets', 'slug' => 'smart-gadgets', 'category_id' => 7, 'created_at' => now(), 'updated_at' => now(),],
            ['child_category' => 'Accessories', 'slug' => 'accessories', 'category_id' => 7, 'created_at' => now(), 'updated_at' => now(),],

            ['child_category' => 'Stuffed Toys', 'slug' => 'stuffed-toys', 'category_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Educational Toys', 'slug' => 'educational-toys', 'category_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Board Games', 'slug' => 'board-games', 'category_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Birthday Gifts', 'slug' => 'birthday-gifts', 'category_id' => 8, 'created_at' => now(), 'updated_at' => now()],

            ['child_category' => 'Mobile Accessories', 'slug' => 'mobile-accessories', 'category_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Gaming Electronics', 'slug' => 'gaming-electronics', 'category_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Audio Devices', 'slug' => 'audio-devices', 'category_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Chargers & Cables', 'slug' => 'chargers-cables', 'category_id' => 9, 'created_at' => now(), 'updated_at' => now()],

            ['child_category' => 'Backpacks', 'slug' => 'backpacks', 'category_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Casual Shoes', 'slug' => 'casual-shoes', 'category_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Handbags', 'slug' => 'handbags', 'category_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Sports Shoes', 'slug' => 'sports-shoes', 'category_id' => 11, 'created_at' => now(), 'updated_at' => now()],

            ['child_category' => 'Accessories & Gadgets', 'slug' => 'accessories-gadgets', 'category_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Airpods', 'slug' => 'airpods', 'category_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Airtag', 'slug' => 'airtag', 'category_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'iPhone', 'slug' => 'iphone', 'category_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'iPhone 12', 'slug' => 'iphone-12', 'category_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'iPhone 13', 'slug' => 'iphone-13', 'category_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'iPhone iOS', 'slug' => 'iphone-ios', 'category_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Organic and Fresh', 'slug' => 'organic-and-fresh', 'category_id' => 12, 'created_at' => now(), 'updated_at' => now()],

            ['child_category' => 'Wellness & Supplements', 'slug' => 'wellness-supplements', 'category_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Natural & Organic', 'slug' => 'natural-organic', 'category_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Makeup', 'slug' => 'makeup', 'category_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Fragrances', 'slug' => 'fragrances', 'category_id' => 13, 'created_at' => now(), 'updated_at' => now()],

            ['child_category' => 'LED Lights', 'slug' => 'led-lights', 'category_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Home Decor', 'slug' => 'home-decor', 'category_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Smart Lighting', 'slug' => 'smart-lighting', 'category_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['child_category' => 'Kitchen & Dining', 'slug' => 'kitchen-dining', 'category_id' => 14, 'created_at' => now(), 'updated_at' => now()],
        ];
        ChildCategory::insert($category_child);
    }
}
