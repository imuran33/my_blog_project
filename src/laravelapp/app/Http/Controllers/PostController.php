<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'content' => 'required|string',
        ]);
    
        // 投稿を保存
        Post::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);
    
        return redirect('/')->with('status', '投稿が完了しました！');
    }
}
