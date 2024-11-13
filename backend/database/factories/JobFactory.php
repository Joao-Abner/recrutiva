<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition()
    {
        // Seleciona um usuário com o papel 'recruiter'
        $user = User::where('role', 'recruiter')->inRandomOrder()->first();

        return [
            'user_id' => $user ? $user->id : null, // Associa a vaga ao recrutador, se existir
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'salary' => $this->faker->randomFloat(2, 3000, 10000), // Salário entre 3000 e 10000
            'location' => $this->faker->city,
            'requirements' => $this->faker->sentence,
        ];
    }
}