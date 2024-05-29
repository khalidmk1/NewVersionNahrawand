<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Client']);
        Role::create(['name' => 'Animateur']);
        Role::create(['name' => 'Formateur']);
        Role::create(['name' => 'Invité']);
        Role::create(['name' => 'Modérateur']);
        Role::create(['name' => 'Conférencier']);
    }
}
