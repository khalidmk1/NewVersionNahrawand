<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Creation Contenu',
            'Modifier Contenu',
            'Suprimer Contenu',
            'Gestion Tickets',
            'Manager Emails',
            'Manager Spearks',
            'Manager Role',
            'Gestion Achat Abonement',
            'Reporting',
            'Correction Quiz'
        ];

        // Loop through each permission and insert it into the database
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
