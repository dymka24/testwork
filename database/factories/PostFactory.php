<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
// database/factories/PostFactory.php

public function definition()
{
    return [
        'person_id' => Person::factory(), // This will create a Person record and associate it with the Post.
        'social_network_id' => SocialNetwork::factory(),
        'content' => $this->faker->text,
        'posted_at' => $this->faker->dateTimeThisYear(),
    ];
}

}
