<?php

namespace Database\Factories;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
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
            'parent_id' => rand(1, 128),
            'user_id' => 1,
            'status' => TaskStatusEnum::TODO->value,
            'priority' => rand(1, 5),
            'title' => fake()->jobTitle,
            'description' => fake()->paragraph(1),
        ];
    }
}
