<?php

namespace Database\Seeders;

use App\Models\Sidebar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sidebars = [
            ['parent_id' => null, 'tab_name' => 'dashboard', 'tab_icons' => 'ri-dashboard-2-line', 'link_url' => 'dashboard', 'tab_order' => 1],
            ['parent_id' => null, 'tab_name' => 'category', 'tab_icons' => 'ri-honour-line', 'link_url' => 'category', 'tab_order' => 2],
            ['parent_id' => null, 'tab_name' => 'child category', 'tab_icons' => 'ri-currency-fill', 'link_url' => 'childcategory', 'tab_order' => 3],
            ['parent_id' => null, 'tab_name' => 'sub-category', 'tab_icons' => 'ri-file-list-3-line', 'link_url' => 'subcategory', 'tab_order' => 4],
            ['parent_id' => null, 'tab_name' => 'brands', 'tab_icons' => 'ri-stack-line', 'link_url' => 'brands', 'tab_order' => 5],
            ['parent_id' => null, 'tab_name' => 'products', 'tab_icons' => 'ri-layout-3-line', 'link_url' => 'dashboard', 'tab_order' => 6],
            ['parent_id' => null, 'tab_name' => 'shipping', 'tab_icons' => 'ri-apps-2-line', 'link_url' => 'dashboard', 'tab_order' => 7],
            ['parent_id' => null, 'tab_name' => 'orders', 'tab_icons' => 'ri-pages-line', 'link_url' => 'dashboard', 'tab_order' => 8],
            ['parent_id' => null, 'tab_name' => 'discount', 'tab_icons' => 'ri-pencil-ruler-2-line', 'link_url' => 'discount', 'tab_order' => 9],
            ['parent_id' => null, 'tab_name' => 'users', 'tab_icons' => 'ri-account-circle-line', 'link_url' => 'dashboard', 'tab_order' => 10],
            ['parent_id' => null, 'tab_name' => 'master Setup', 'tab_icons' => 'ri-pie-chart-line', 'link_url' => 'dashboard', 'tab_order' => 11],

            ['parent_id' => 2, 'tab_name' => 'master-category', 'tab_icons' => null, 'link_url' => 'category', 'tab_order' => 1],
            ['parent_id' => 2, 'tab_name' => 'bulk upload', 'tab_icons' => null, 'link_url' => 'category-bulkupload', 'tab_order' => 2],
            ['parent_id' => 3, 'tab_name' => 'master-child-category', 'tab_icons' => null, 'link_url' => 'childcategory', 'tab_order' => 1],
            ['parent_id' => 3, 'tab_name' => 'bulk upload', 'tab_icons' => null, 'link_url' => 'childcategory-bulkupload', 'tab_order' => 2],
            ['parent_id' => 4, 'tab_name' => 'master-sub-category', 'tab_icons' => null, 'link_url' => 'subcategory', 'tab_order' => 1],
            ['parent_id' => 4, 'tab_name' => 'bulk-upload', 'tab_icons' => null, 'link_url' => 'subcategory-bulkupload', 'tab_order' => 2],
            ['parent_id' => 5, 'tab_name' => 'master brand', 'tab_icons' => null, 'link_url' => 'brands', 'tab_order' => 1],
            ['parent_id' => 5, 'tab_name' => 'bulk upload', 'tab_icons' => null, 'link_url' => 'brands-bulkupload', 'tab_order' => 2],
            ['parent_id' => 6, 'tab_name' => 'product', 'tab_icons' => null, 'link_url' => 'product', 'tab_order' => 1],
            ['parent_id' => 6, 'tab_name' => 'product image', 'tab_icons' => null, 'link_url' => 'product-image', 'tab_order' => 2],
            ['parent_id' => 6, 'tab_name' => 'create product', 'tab_icons' => null, 'link_url' => 'create-product', 'tab_order' => 3],
            ['parent_id' => 6, 'tab_name' => 'create image', 'tab_icons' => null, 'link_url' => 'create-product-image', 'tab_order' => 4],

        ];
        Sidebar::insert($sidebars);
    }
}
