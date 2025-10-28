<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departement;

class DepartementSeeder extends Seeder
{
    public function run(): void
    {
        $departements = [
            ['nama_departement' => 'IT Support'],
            ['nama_departement' => 'Network'],
            ['nama_departement' => 'HRD'],
            ['nama_departement' => 'Finance'],
            ['nama_departement' => 'Maintenance'],
        ];

        foreach ($departements as $dept) {
            Departement::firstOrCreate($dept);
        }
    }
}
