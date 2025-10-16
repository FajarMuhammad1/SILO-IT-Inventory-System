<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InventoryFactory extends Factory
{
    public function definition()
    {
        $tipe = $this->faker->randomElement(['consumable', 'non-consumable']);
        $status = $this->faker->randomElement(['ok','rusak','hilang','dipakai']);
        return [
            'nama_barang' => $this->faker->word() . ' ' . $this->faker->randomElement(['Laptop','Monitor','Printer','Cable','Router']),
            'kategori' => $this->faker->randomElement(['Laptop','Peripheral','Network','Consumable']),
            'merk' => $this->faker->randomElement(['HP','Dell','Lenovo','Asus']),
            'serial_number' => strtoupper(Str::random(8)),
            'tipe_barang' => $tipe,
            'jumlah' => $this->faker->numberBetween(1,10),
            'tanggal_masuk' => $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'po_number' => 'PO-' . $this->faker->numberBetween(1000,9999),
            'lokasi' => $this->faker->randomElement(['Gudang A','Gudang B','IT Office']),
            'status' => $status,
            'barcode' => (string) Str::uuid(),
            'gambar' => null,
        ];
    }
}
