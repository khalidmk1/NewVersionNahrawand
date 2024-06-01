<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure foreign key checks are disabled to avoid issues during seeding
        Schema::disableForeignKeyConstraints();

        // Truncate the table before seeding
        DB::table('objectives')->truncate();

        // Seed the objectives table with sample data
            $objectives = [
                [
                    'subCategoryId' => 1,
                    'name' => 'BEAUTY',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 1,
                    'name' => 'أريد أن أتعلم أساسيات الاعتناء ببشرتي',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 1,
                    'name' => 'أريد أن أسير ميزانيتي الشخصية بشكل فعال',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 5,
                    'name' => 'أريد تعلم أساسيات الاستثمار',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subCategoryId' => 8,
                    'name' => 'أريد انشاء مشروعي الخاص',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 8,
                    'name' => 'أريد تعلم التجارة الالكترونية',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 8,
                    'name' => 'أريد تعلم أساسيات التسويق الرقمي',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 9,
                    'name' => 'أريد أن أتعامل مع التراكمات النفسية بحكمة أكبر',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 1,
                    'name' => 'أريد فهم من حولي بشكل أعمق',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' =>now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 9,
                    'name' => 'أريد فهم من حولي بشكل أعمق',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 9,
                    'name' => 'أريد تجاوز العقبات في حياتي بمرونة أكبر',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 10,
                    'name' => 'أود بناء علاقات قوية',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 10,
                    'name' => 'أود نعلم مهارات التواصل مع الاخرين',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 10,
                    'name' => 'أريد علاقات صحية و إيجابية مع محيطي',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 2,
                    'name' => 'أريد أن أصبح أكثر جاذبية و تأثيرا في من حولي',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 9,
                    'name' => 'أريد أن أصبح أكثر جاذبية و تأثيرا في من حولي',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 10,
                    'name' => 'أريد أن أصبح أكثر جاذبية و تأثيرا في من حولي',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 11,
                    'name' => 'أريد تقوية ذاكرتي',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 11,
                    'name' => 'أريد تقوية تركيزي',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 11,
                    'name' => 'بغيت نمي المهارات العقلية ديالي',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 11,
                    'name' => 'بغيت نتعلم كيفاش نتعامل مع الانتقادات و التعاليق السلبية	',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 7,
                    'name' => 'بغيت نطور مهارات الاستماع الفعال	',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 11,
                    'name' => 'بغيت نطور مهارات الاستماع الفعال',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 11,
                    'name' => 'بغيت نمي وعيي بذاتي و نتعرف أكثر على نفسي',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 12,
                    'name' => 'أريد بناء علامة ذاتية مؤثرة',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 13,
                    'name' => 'اتقان فن التفاوض التجاري',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 11,
                    'name' => 'الذكاء العاطفي',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 11,
                    'name' => 'الثقة بالنفس	',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 11,
                    'name' => 'إدارة التوتر	',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'subCategoryId' => 14,
                    'name' => 'التخلص من التوتر',
                    'isUpdated' => false,
                    'isDelete' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            // Add more objectives as needed
        ];

        // Insert the objectives data
        DB::table('objectives')->insert($objectives);

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }
}
