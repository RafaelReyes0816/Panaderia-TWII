<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventario>
 */
class InventarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'producto_id' => \App\Models\Producto::factory(),
        'tipo_movimiento' => $this->faker->randomElement(['entrada', 'salida']),
        'cantidad' => $this->faker->numberBetween(1, 50),
        'fecha' => $this->faker->dateTimeThisYear,
        'observacion' => $this->faker->optional()->sentence,
        ];
    }
}
