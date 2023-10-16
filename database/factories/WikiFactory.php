<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WikiFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'content' => fake()->paragraph,
        ];
    }
}
