<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Cria um novo usuário ou use um existente
            'job_id' => Job::factory(), // Cria uma nova vaga ou use uma existente
            'status' => $this->faker->randomElement(['applied', 'interviewed', 'hired', 'rejected']),
            'applied_at' => $this->faker->dateTime(),
        ];
    }
}
