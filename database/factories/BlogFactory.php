<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
    	return [
    	    'title' => $this->faker->realText(30),
    	    'content' => $this->faker->realTextBetween(200,1000),
    	    'user_id' => User::all()->random()->id,
    	];
    }
}
