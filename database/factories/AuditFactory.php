<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AuditFactory extends Factory
{
    public function definition()
    {
        return [
            'tanggal_audit' => $this->faker->date(),
            'status' => $this->faker->randomElement(['ok','rusak','hilang','dipakai']),
            'keterangan' => $this->faker->optional()->sentence(),
        ];
    }
}
