<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $latestPosts = Post::orderBy('created_at', 'desc')->take(5)->get();
        return view('welcome', compact('latestPosts'));
    }

    public function showMyPage()
    {
        $user = Auth::user();
        $favorites = $user->favoritePosts()->latest()->paginate(10);

        // 管理者であれば投稿機能を表示
        if ($user->isAdmin()) {
            return view('commons.mypage', [
                'canPost' => true,
                'favorites' => $favorites,
            ]);
        }

        return view('commons.mypage', [
            'canPost' => false,
            'favorites' => $favorites,
        ]);
    }

    // 編集画面表示
    public function edit()
    {
        return view('user.edit', ['user' => auth()->user()]);
    }

    // 更新処理
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('showMyPage')->with('status', 'プロフィールを更新しました。');
    }
}
