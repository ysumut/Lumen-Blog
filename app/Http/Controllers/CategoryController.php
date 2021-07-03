<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return $this->unlimited_children(
            Category::select('id','name','parent_id','rank')->where('parent_id', 0)->get()
        );
    }

    private function unlimited_children($categories) {
        foreach ($categories as $each) {
            $children = $each->children()->select('id','name','parent_id','rank')->orderBy('rank')->get();

            if(count($children) > 0) {
                $each->children =  $children;
                $this->unlimited_children($children);
            }
            //unset($each->id);
        }

        return $categories;
    }
}
