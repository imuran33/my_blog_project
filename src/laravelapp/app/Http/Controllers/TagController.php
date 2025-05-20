<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function showPostsByTag($name)
    {
        $tag = Tag::where('name', $name)->firstOrFail();
        $posts = $tag->posts()->latest()->paginate(10); // 10件ずつ表示

        return view('tag.posts', compact('tag', 'posts'));
    }
}
