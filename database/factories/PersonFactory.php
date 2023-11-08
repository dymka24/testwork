<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

public function definition()
{
    return [
        'content' => $this->faker->text(200),
        'posted_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
        'person_id' => Person::factory(),
        'social_network_id' => SocialNetwork::factory(),
        // Other fields as necessary
    ];
}

    
}
