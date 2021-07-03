<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function parent() {
        return $this->hasOne(Category::class, 'id','parent_id')->select('id','name','parent_id','rank');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id','id')->select('id','name','parent_id','rank');
    }
}
