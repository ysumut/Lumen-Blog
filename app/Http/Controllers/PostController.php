<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collection;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:10|max:255',
            'post_content' => 'required|string|min:50|max:1000',
            'category_id' => 'required|numeric|exists:categories,id'
        ]);
        if($validator->fails())
            return (new Collection([]))->add(false, $validator->errors()->all());

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->post_content;
        $post->user_id = Auth::id();
        $post->category_id = $request->category_id;
        $post->save();

        return (new Collection([]))->add(true, ['Successfully post added!']);
    }
}
