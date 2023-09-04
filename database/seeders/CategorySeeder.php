<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ['Infrastruktur', 'Lingkungan', 'Layanan Publik', 'Keamanan', 'Kesehatan', 'Lain-lain'];

        foreach ($category as $categoryName) {
            Category::create([
                "name" => $categoryName,
                "slug" => Str::slug($categoryName)
            ]);
        }
    }
}
