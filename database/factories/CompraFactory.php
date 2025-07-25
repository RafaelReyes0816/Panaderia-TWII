<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compra>
 */
class CompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'proveedor_id' => \App\Models\Proveedor::factory(),
        'fecha' => $this->faker->dateTimeThisYear,
        'total' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
