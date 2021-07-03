<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public function creator() {
        return $this->hasOne(User::class,'id','user_id')->select('id','email','username');
    }

    public function category() {
        return $this->hasOne(Category::class,'id','category_id')->select('id','name');
    }
}
