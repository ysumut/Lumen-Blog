<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    public function creator() {
        return $this->hasOne(User::class,'id','user_id')->select('id','email','username');
    }

    public function category() {
        return $this->hasOne(Category::class,'id','category_id')->select('id','name');
    }
}
