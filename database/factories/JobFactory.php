<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location_id'=>$this->faker->numberBetween(1, 5),
            'title' => $this->faker->jobTitle(),
            'date_start' => $this->faker->date(),
            'date_end' => $this->faker->date(),
            'salary' => $this->faker->numberBetween(1, 5000),
            'description_job' => $this->faker->text(191),
        ];
    }
}
