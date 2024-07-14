<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'session_id' => Session::factory(),
            'url' => fake()->url(),
            'type' => fake()->word(),
            'data' => ['key' => 'value'],
        ];
    }
}
