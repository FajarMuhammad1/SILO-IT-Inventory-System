<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityLogFactory extends Factory
{
    public function definition()
    {
        return [
            'aksi' => $this->faker->randomElement(['tambah barang','edit barang','hapus barang','audit']),
            'deskripsi' => $this->faker->sentence(),
        ];
    }
}
