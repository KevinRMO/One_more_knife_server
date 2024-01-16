<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\location>
 */
class LocationFactory extends Factory
{

    public function definition(): array
    {
        return [
            'company_id'=>$this->faker->numberBetween(1, 5),
            'title' => $this->faker->lastName(),
            'zip_code' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'description_location' => $this->faker->text(191),
        ];
    }
}
