<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent_categories = Category::factory()->count(10)->create();

        foreach ($parent_categories as $parent) {
            $rank = 1;

            for($i = 0; $i < rand(0,6); $i++) {
                $category = Category::factory()->count(1)->create([
                    'parent_id' => $parent->id,
                    'rank' => $rank++
                ]);

                $rank2 = 1;
                for($i = 0; $i < rand(0,3); $i++) {
                    Category::factory()->count(1)->create([
                        'parent_id' => $category[0]->id,
                        'rank' => $rank2++
                    ]);
                }
            }
        }
    }
}
