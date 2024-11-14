<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('senha123'), // Use bcrypt para hashear a senha
            'role' => $this->faker->randomElement(['candidate', 'recruiter']), // Gera aleatoriamente entre os valores válidos
        ];
    }
}