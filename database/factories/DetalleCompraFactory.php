<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleCompra>
 */
class DetalleCompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'compra_id' => \App\Models\Compra::factory(),
        'producto_id' => \App\Models\Producto::factory(),
        'cantidad' => $this->faker->numberBetween(1, 10),
        'precio_unitario' => $this->faker->randomFloat(2, 1, 1000),
        'subtotal' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
