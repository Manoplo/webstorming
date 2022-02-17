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
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['E-commerce', 'Blog', 'Social Network', 'Chat', 'Web3', 'CMS', 'Education', 'Admin', 'Medical', 'Dashboard', 'Service', 'Other']),
            'stack_id' => \App\Models\Stack::all()->random()->id,
            'user_id' => \App\Models\User::all()->random()->id
        ];
    }
}
