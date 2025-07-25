<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleVenta>
 */
class DetalleVentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'venta_id' => \App\Models\Venta::factory(),
        'producto_id' => \App\Models\Producto::factory(),
        'cantidad' => $this->faker->numberBetween(1, 10),
        'subtotal' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
