<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\ProfilEmployer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        // Create a parent employer user + profil so the FK constraint is satisfied
        $employerUser  = User::factory()->create(['role' => 'employer']);
        $employerProfil = ProfilEmployer::forceCreate([
            'id_utilisateur'   => $employerUser->id,
            'nom_entreprise'   => $this->faker->company(),
            'adresse'          => $this->faker->address(),
            'description'      => $this->faker->paragraph(),
            'telephone'        => $this->faker->phoneNumber(),
            'secteur_activite' => 'Technology',
        ]);

        return [
            'id_employeur'     => $employerProfil->id,
            'titre'            => $this->faker->jobTitle(),
            'description'      => $this->faker->paragraph(3),
            'location'         => $this->faker->city(),
            'job_type'         => $this->faker->randomElement(['Full-time', 'Part-time', 'Freelance', 'Remote']),
            'salaire'          => $this->faker->numberBetween(2000, 15000),
            'categorie'        => $this->faker->randomElement(['IT', 'Marketing', 'Finance', 'HR', 'Engineering']),
            'type_contrat'     => $this->faker->randomElement(['CDI', 'CDD', 'Internship', 'Freelance']),
            'date_publication' => $this->faker->date(),
            'company'          => $employerProfil->nom_entreprise,
        ];
    }
}
