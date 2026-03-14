<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Condominium;
use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Super Admin CondoFlow',
            'email' => 'superadmin@condoflow.com',
            'password' => Hash::make('password'),
            'is_super_admin' => true,
            'condominium_id' => null,
        ]);

        $condominium = Condominium::factory()->create([
            'name' => 'Sunset Boulevard',
            'tax_id' => '00.000.000/0001-00',
        ]);

        User::factory()->create([
            'name' => 'Admin Syndic',
            'email' => 'syndic@sunsetboulevard.condoflow.com',
            'password' => Hash::make('password'),
            'condominium_id' => $condominium->id,
        ]);

        $blocks = ['A', 'B', 'C', 'D'];

        foreach ($blocks as $block) {
            Apartment::factory()->count(4)->state(new Sequence(fn($sequence) => [
                'block' => $block,
                'number' => (string) (101 + $sequence->index),
            ]))->create([
                'condominium_id' => $condominium->id,
            ]);
        }
    }
}
