<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'    => 1,
            'contact_id' => Contact::inRandomOrder()->first()->id,
            'message'    => $this->faker->paragraph(),
            'is_read'    => $this->faker->boolean(30),
            'origin'     => $this->faker->randomElement(['sent', 'received']),
        ];
    }
}
