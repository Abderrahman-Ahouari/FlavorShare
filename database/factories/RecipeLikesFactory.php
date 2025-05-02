<?php

namespace Database\Factories;
use App\Models\RecipeLike;
use App\Models\User;
use App\Models\Recipe;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\recipe_likes>
 */
class RecipeLikesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = recipe_likes::class;

     public function definition()
     {
         return [
             'user_id' => User::factory(),
             'recipe_id' => Recipe::factory(),
             'type' => $this->faker->randomElement(['like', 'dislike']),
         ];
     }

}
