<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collection;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('creator')->where('user_id', Auth::id())->get();
        foreach ($blogs as $b) {
            unset($b->user_id);
            unset($b->creator->id);
        }

        return (new Collection($blogs))->add(true, ['Blogs listed.']);
    }
}
