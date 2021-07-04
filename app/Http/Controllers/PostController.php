<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collection;
use App\Http\Resources\PaginateCollection;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('creator','category');
        if($request->categoryIDs)
            $posts = $posts->whereIn('category_id', explode(',', $request->categoryIDs));

        $posts = $posts->paginate();
        foreach ($posts as $p) {
            unset($p->user_id);
            unset($p->category_id);
        }

        return (new PaginateCollection($posts))->additional([true, ['Posts listed.']]);
    }

    public function show($id)
    {
        $post = Post::with('creator','category')->find($id);
        if($post) {
            unset($post->user_id);
            unset($post->category_id);
            return (new Collection($post))->add(true, ['Post listed.']);
        }
        else {
            return (new Collection($post))->add(false, ['Post not found!']);
        }
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

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'string|min:10|max:255',
            'post_content' => 'string|min:50|max:1000',
            'category_id' => 'numeric|exists:categories,id'
        ]);
        if($validator->fails())
            return (new Collection([]))->add(false, $validator->errors()->all());

        $post = Post::query()->where('user_id', Auth::id())->find($id);
        if(!$post)
            return (new Collection([]))->add(false, ['Post is not found!']);

        $post->title = $request->title ?? $post->title;
        $post->content = $request->post_content ?? $post->content;
        $post->category_id = $request->category_id ?? $post->category_id;
        $post->save();

        return (new Collection([]))->add(true, ['Successfully post updated!']);
    }

    public function destroy($id) {
        $post = Post::query()->where('user_id', Auth::id())->find($id);
        if(!$post)
            return (new Collection([]))->add(false, ['Post is not found!']);

        $post->delete();
        return (new Collection([]))->add(true, ['Successfully post deleted!']);
    }
}
