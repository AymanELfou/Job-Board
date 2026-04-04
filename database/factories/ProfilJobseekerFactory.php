<?php

namespace Database\Factories;

use App\Models\ProfilJobseeker;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfilJobseekerFactory extends Factory
{
    protected $model = ProfilJobseeker::class;

    public function definition(): array
    {
        return [
            'id_utilisateur'      => User::factory()->create(['role' => 'Job Seeker'])->id,
            'fullName'            => $this->faker->name(),
            'competences'         => implode(', ', $this->faker->words(5)),
            'experience'          => $this->faker->randomElement(['Junior', 'Mid-level', 'Senior', 'Lead']),
            'education'           => $this->faker->randomElement(['Bac', 'Bac+2', 'Bac+3', 'Bac+5', 'PhD']),
            'contact_information' => $this->faker->phoneNumber(),
            'resume'              => null,
        ];
    }
}
