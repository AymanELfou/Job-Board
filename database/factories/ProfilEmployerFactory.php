<?php

namespace Database\Factories;

use App\Models\ProfilEmployer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfilEmployerFactory extends Factory
{
    protected $model = ProfilEmployer::class;

    public function definition(): array
    {
        return [
            'id_utilisateur'    => User::factory()->create(['role' => 'employer'])->id,
            'nom_entreprise'    => $this->faker->company(),
            'adresse'           => $this->faker->address(),
            'description'       => $this->faker->paragraph(2),
            'telephone'         => $this->faker->phoneNumber(),
            'secteur_activite'  => $this->faker->randomElement(['Technology', 'Finance', 'Healthcare', 'Education', 'Retail']),
        ];
    }
}
