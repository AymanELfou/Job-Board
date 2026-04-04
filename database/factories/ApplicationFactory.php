<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition(): array
    {
        return [
            'id_jobseeker' => null,
            'id_job'       => null,
            'status'       => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
            'cover_letter' => $this->faker->paragraph(2),
            'resume'       => null,
        ];
    }
}
