<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Ensure foreign key checks are disabled to avoid issues during seeding
         Schema::disableForeignKeyConstraints();

         // Truncate the table before seeding
         DB::table('sub_categories')->truncate();
 
         // Seed the sub_categories table with sample data
         $subCategories = [
             [
                 'categoryId' => 4,
                 'avatar' => null,
                 'name' => 'Beauté & Elegance ',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 4,
                 'avatar' => null,
                 'name' => 'أناقة و جمال',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 3,
                 'avatar' => null,
                 'name' => 'التسويق',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 2,
                 'avatar' => null,
                 'name' => 'التسويق',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 1,
                 'avatar' => null,
                 'name' => 'الذكاء المالي',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 1,
                 'avatar' => null,
                 'name' => 'الاستثمار',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 5,
                 'avatar' => null,
                 'name' => 'التغدية الصحية',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 11,
                 'avatar' => null,
                 'name' => 'التسويق الرقمي',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 13,
                 'avatar' => null,
                 'name' => 'حياة و مجتمع',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 7,
                 'avatar' => null,
                 'name' => 'بناء العلاقات',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 13,
                 'avatar' => null,
                 'name' => 'المهارات اللينة',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 11,
                 'avatar' => null,
                 'name' => ' التسويق الذاتي',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 14,
                 'avatar' => null,
                 'name' => 'التفاوض التجاري',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                 'categoryId' => 4,
                 'avatar' => null,
                 'name' => ' الضغط النفسي',
                 'description' => null,
                 'isUpdated' => false,
                 'isDelete' => false,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             // Add more subcategories as needed
         ];
 
         // Insert the subcategories data
         DB::table('sub_categories')->insert($subCategories);
 
         // Re-enable foreign key checks
         Schema::enableForeignKeyConstraints();
    }
}
