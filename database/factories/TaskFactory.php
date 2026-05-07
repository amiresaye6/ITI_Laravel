<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'user_id' => User::inRandomOrder()->first()->id,
            'priority' => $this->faker->randomElement(['Low', 'Medium', 'High', 'Urgent']),
            'completed' => $this->faker->boolean(),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
