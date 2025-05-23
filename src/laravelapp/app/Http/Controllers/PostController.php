<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $validCategories = ['programming', 'music', 'food', 'diary', 'memoir'];

    public function index($category)
    {
        if (!in_array($category, $this->validCategories)) {
            abort(404);
        }

        $posts = Post::where('category', $category)->latest()->paginate(10);

        // カテゴリごとの表示文言
        $categoryTitles = [
            'programming' => [
                'title' => 'Programming',
                'heading' => 'プログラミングページへようこそ！',
                'description' => 'ここは〇〇が作ったものや学んだことを記録する場所です。',
            ],
            'music' => [
                'title' => 'Music',
                'heading' => '音楽ページへようこそ！',
                'description' => 'ここは〇〇が好きな音楽や作った曲などを記録する場所です。',
            ],
            'food' => [
                'title' => 'Food',
                'heading' => '食べ物ページへようこそ！',
                'description' => 'ここは〇〇が食べたごはんやおやつをさらけ出す場所です。',
            ],
            'diary' => [
                'title' => 'Diary',
                'heading' => '日記ページへようこそ！',
                'description' => 'ここは〇〇がそのほか思ったことや感じたこと、体験をさらけ出す場所です。',
            ],
            'memoir' => [
                'title' => 'Memoir',
                'heading' => '回想ページへようこそ！',
                'description' => 'ここはある人間の過去を記録する場所です。',
            ],
        ];

        $info = $categoryTitles[$category] ?? [
            'title' => ucfirst($category),
            'heading' => 'ようこそ！',
            'description' => '',
        ];

        // カテゴリごとにビューを分けたいなら：category.blade.phpなどに分岐も可能
        return view('categories.index', compact('posts', 'category', 'info'));
    }

    public function show($category, $id)
    {
        if (!in_array($category, $this->validCategories)) {
            abort(404);
        }

        $post = Post::where('id', $id)->where('category', $category)->firstOrFail();

        return view('categories.detail', compact('post', 'category'));
    }

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

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Post::query();

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        if (trim($request->keyword) === '') {
            return redirect()->back()->with('error', '検索ワードを入力してください');
        }

        $posts = $query->latest()->paginate(10);

        return view('search.results', compact('posts', 'keyword'));
    }
}
