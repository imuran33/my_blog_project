<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class FoodController extends Controller
{
    public function index()
    {
        // DBから投稿を取得（最新順）
        $posts = Post::where('category', 'food')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('categories.food', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);

        // 投稿が存在しない場合は404
        if (!$post) {
            abort(404);
        }

        return view('categories.food_detail', compact('post'));
    }
}