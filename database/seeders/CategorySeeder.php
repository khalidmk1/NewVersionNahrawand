<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure foreign key checks are disabled to avoid issues during seeding
        Schema::disableForeignKeyConstraints();

        // Truncate the table before seeding
        DB::table('categories')->truncate();

        // Seed the categories table with sample data
        $categories = [
            [
                'domainId' => 1,
                'name' => 'التدبير المالي',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 1,
                'name' => 'ريادة الأعمال',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 1,
                'name' => 'الحياة المهنية',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 2,
                'name' => 'الصحة النفسية',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 2,
                'name' => 'الصحة الجسدية',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 3,
                'name' => 'العلاقة الزوجية',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 3,
                'name' => 'العلاقات الاجتماعية',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 4,
                'name' => 'الصورة العامة',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 4,
                'name' =>'الشغف و الهوايات',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 4,
                'name' =>'الأنوثة		',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 1,
                'name' =>'التسويق',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 4,
                'name' =>'التميز',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 4,
                'name' =>'المهارات الحياتية',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'domainId' => 1,
                'name' =>'التجارة و الأعمال',
                'isUpdated' => false,
                'isDelete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more categories as needed
        ];

        // Insert the categories data
        DB::table('categories')->insert($categories);

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }
}
