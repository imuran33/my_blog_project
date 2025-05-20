<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ProgrammingController extends Controller
{
    public function index()
    {
        // DBから投稿を取得（最新順）
        $posts = Post::where('category', 'programming')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('categories.programming', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::with('tags')->findOrFail($id);

        // 投稿が存在しない場合は404
        if (!$post) {
            abort(404);
        }

        return view('categories.programming_detail', compact('post'));
    }
}
