<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\notice_user>
 */
class NoticeUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id'=>$this->faker->numberBetween(1, 5),
            'user_id'=>$this->faker->numberBetween(1, 5),
            'comment' => $this->faker->text(),
            'rate_user' => $this->faker->numberBetween(1, 5),
        ];
    }
}
