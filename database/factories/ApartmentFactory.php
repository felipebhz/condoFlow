<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Apartment;
use App\Models\Condominium;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Apartment>
 */
final class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'condominium_id' => Condominium::factory(),
            'block' => 'A',
            'number' => '100',
            'parking_spot_limit' => fake()->numberBetween(1, 2),
        ];
    }
}
