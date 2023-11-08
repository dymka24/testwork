<?php

namespace Database\Factories;

use App\Models\SocialNetwork;
use App\Models\User;
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
    public function definition(): array
    {
        return [
            'title'=>fake()->title,
            'content'=>fake()->paragraph(rand(10,20)),
            'social_network_id'=>SocialNetwork::inRandomOrder()->first()->id,
            'user_id'=>User::inRandomOrder()->first()->id
        ];
    }
}
