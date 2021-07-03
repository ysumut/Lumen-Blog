<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collection;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('creator','category')->where('user_id', Auth::id())->get();
        foreach ($posts as $p) {
            unset($p->user_id);
            unset($p->category_id);
        }

        return (new Collection($posts))->add(true, ['Posts listed.']);
    }
}
