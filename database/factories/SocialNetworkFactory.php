<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SocialNetwork>
 */
class SocialNetworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
  // database/factories/SocialNetworkFactory.php

public function definition()
{
    return [
        'name' => $this->faker->randomElement(['Facebook', 'Twitter', 'Instagram']),
        'url' => $this->faker->url,
    ];
}

}
