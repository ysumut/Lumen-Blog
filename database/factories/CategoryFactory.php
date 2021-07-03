<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;
    public static $rank = 1;

    public function definition(): array
    {
    	return [
    	    'name' => $this->faker->text(15),
    	    'parent_id' => 0,
    	    'rank' => self::$rank++
    	];
    }
}
