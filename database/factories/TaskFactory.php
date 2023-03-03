<?php

namespace Database\Factories;

use App\Models\Todo;
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
                
                'todo_id'       =>  Todo::all()->random()->id,
                'name'          =>  fake()->name(),
                'description'   =>  $this->faker->text(),
                'status'        =>  $this->faker->randomElement(['0','1'])

        ];
    }
}
