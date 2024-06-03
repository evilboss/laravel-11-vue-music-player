<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $minutes = $this->faker->numberBetween(1, 10);
        $seconds = $this->faker->numberBetween(0, 59);
        $duration = sprintf('%02d:%02d', $minutes, $seconds); // Format as MM:SS
        $durationInSeconds = ($minutes * 60) + $seconds;

        return [
            'title' => $this->faker->words(3, true),
            'artist' => $this->faker->name(),
            'duration' => $duration,
            'durationInSeconds' => $durationInSeconds

        ];
    }
}
