<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'start_date' => $this->faker->dateTimeBetween('-7 days', '+7 days'),
            'end_date' => $this->faker->dateTimeBetween('+8 days', '+30 days'),
            'total_budget' => $this->faker->randomFloat(2, 100, 1000),
            'daily_budget' => $this->faker->randomFloat(2, 10, 100),
            'creative_upload' => $this->faker->shuffleArray([
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
            ]),
        ];
    }
}
