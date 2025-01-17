<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ShowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'image' => $this->faker->imageUrl(640, 480, 'shows', true, 'Faker'),
            'description' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['TV', 'Movie', 'OVA', 'Special']),
            'studios' => $this->faker->company,
            'date_aired' => $this->faker->date,
            'status' => $this->faker->randomElement(['Ongoing', 'Completed', 'Upcoming']),
            'genre' => $this->faker->randomElement(['Action', 'Adventure', 'Comedy', 'Drama', 'Fantasy', 'Horror']),
            'duration' => $this->faker->numberBetween(20, 120) . ' min',
            'quality' => $this->faker->randomElement(['HD', 'SD', '4K']),
        ];
    }
}
