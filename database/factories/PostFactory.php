<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
    	return [
    	    'title' => $this->faker->realText(30),
    	    'content' => $this->faker->realTextBetween(200,1000),
    	    'user_id' => User::all()->random()->id,
    	    'category_id' => Category::all()->random()->id,
    	];
    }
}
