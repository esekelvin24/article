<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'cover' => $this->faker->imageUrl(),
            'full_text' => $this->faker->text('50'),
        ];
    }
}
