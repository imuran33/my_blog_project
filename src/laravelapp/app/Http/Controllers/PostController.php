<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        $tags = Tag::all(); // タグ一覧取得
        return view('post.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'content' => 'required|string',
            'tags' => 'nullable|string', // ← JSON文字列として受け取る
            'tags.*' => 'exists:tags,id', // 存在するタグIDのみ
        ]);

        // 投稿を保存
        $post = Post::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        // タグの処理（文字列 → 配列）
        if ($request->filled('tags')) {
            $tagNames = collect(json_decode($request->tags))
                ->pluck('value')
                ->map(function ($name) {
                    return Tag::firstOrCreate(['name' => $name])->id;
                });

            $post->tags()->sync($tagNames);
        }

        return redirect('/')->with('status', '投稿が完了しました！');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $tags = Tag::all(); // タグ一覧取得
        return view('post.edit', compact('post', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->category = $request->input('category');
        $post->content = $request->input('content');
        $post->save();

        // タグ処理
        if ($request->filled('tags')) {
            $tagIds = collect(json_decode($request->tags))
                ->pluck('value')
                ->map(function ($name) {
                    return Tag::firstOrCreate(['name' => $name])->id;
                });

            $post->tags()->sync($tagIds);
        }

        return redirect("/{$post->category}/{$post->id}")->with('status', '編集が完了しました！');
    }
}
