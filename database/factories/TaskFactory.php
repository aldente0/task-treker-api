<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\TaskStatus;
use App\Models\TaskType;
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
            'project_id' => Project::all('id')->random(),
            'task_status_id' => TaskStatus::all('id')->random(),
            'task_type_id' => TaskType::all('id')->random(),
            'title' => $this->faker->word,
            'description' => $this->faker->text,
        ];
    }
}
