<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HelpdeskMonitoring;
use App\Models\User;
use App\Models\Departement;

class HelpdeskMonitoringSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // Ambil user pertama
        $departement = Departement::first(); // Ambil departement pertama

        HelpdeskMonitoring::create([
            'user_id' => $user->id ?? 1,
            'departement_id' => $departement->id ?? 1,
            'tanggal' => now(),
            'deskripsi' => 'Koneksi internet putus di ruangan HRD',
            'status' => 'progress',
            'pic' => 'Teknisi A',
        ]);
    }
}
