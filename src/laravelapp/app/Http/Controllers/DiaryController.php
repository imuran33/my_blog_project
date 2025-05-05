<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class DiaryController extends Controller
{
    public function index()
    {
        // DBから投稿を取得（最新順）
        $posts = Post::where('category', 'diary')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('categories.diary', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);

        // 投稿が存在しない場合は404
        if (!$post) {
            abort(404);
        }

        return view('categories.diary_detail', compact('post'));
    }
}