<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['brands' => 'Nalli Silks', 'slug' => 'nalli-silks',],
            ['brands' => 'Kanchipuram Silks', 'slug' => 'kanchipuram-silks',],
            ['brands' => 'Suta', 'slug' => 'suta',],
            ['brands' => 'Taneira', 'slug' => 'taneira',],
            ['brands' => 'Fabindia', 'slug' => 'fabindia',],
            ['brands' => 'Banarasi', 'slug' => 'banarasi',],
            ['brands' => 'Peter England', 'slug' => 'peter-england',],
            ['brands' => 'Louis Philippe', 'slug' => 'louis-philippe',],
            ['brands' => 'Van Heusen', 'slug' => 'van-heusen',],
            ['brands' => 'Raymond', 'slug' => 'raymond',],
            ['brands' => 'Allen Solly', 'slug' => 'allen-solly',],
            ['brands' => 'Samsung', 'slug' => 'samsung',],
            ['brands' => 'Apple', 'slug' => 'apple',],
            ['brands' => 'Sony', 'slug'  => 'sony',],
            ['brands' => 'LG', 'slug' => 'lg',],
            ['brands' => 'Mi', 'slug' => 'mi',],
            ['brands' => 'Xiaomi', 'slug' => 'xiaomi',],
            ['brands' => 'Realme', 'slug' => 'realme',],
            ['brands' => 'Vivo', 'slug' => 'vivo',],
            ['brands' => 'Oppo', 'slug' => 'oppo',],
        ];
        Brand::insert($brands);
    }
}
