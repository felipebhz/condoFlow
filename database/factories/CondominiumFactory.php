<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Condominium;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Condominium>
 */
final class CondominiumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . ' Condominium',
            'tax_id' => $this->faker->unique()->numerify('##.###.###/####-##'),
            'is_active' => true,
        ];
    }
}
