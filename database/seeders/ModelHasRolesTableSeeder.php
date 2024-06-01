<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModelHasRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['role_id' => 4, 'model_type' => 'App\\Models\\User', 'model_id' => 2], 
            ['role_id' => 5, 'model_type' => 'App\\Models\\User', 'model_id' => 3], 
            ['role_id' => 5, 'model_type' => 'App\\Models\\User', 'model_id' => 4],
            ['role_id' => 5, 'model_type' => 'App\\Models\\User', 'model_id' => 5],
            ['role_id' => 5, 'model_type' => 'App\\Models\\User', 'model_id' => 6],
            ['role_id' => 4, 'model_type' => 'App\\Models\\User', 'model_id' => 7],
            ['role_id' => 5, 'model_type' => 'App\\Models\\User', 'model_id' => 8],
            ['role_id' => 5, 'model_type' => 'App\\Models\\User', 'model_id' => 9],
            ['role_id' => 5, 'model_type' => 'App\\Models\\User', 'model_id' => 10],
        ];

        DB::table('model_has_roles')->insert($roles);
    }
}
