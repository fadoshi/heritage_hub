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
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),
            'image' => $this->getImageFromResources(),
            'user_id' => '1',
        ];
    }

    /**
     * Get the full path to the image from the resources folder.
     */
    private function getImageFromResources()
    {        
        // Return the relative path for use in views or asset loading
        return 'ganesh.jpg';
    }
}
