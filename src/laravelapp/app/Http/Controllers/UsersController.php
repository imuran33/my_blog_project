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
        $latestPosts = Post::orderBy('created_at', 'desc')->take(5)->get(); // 最新5件

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
}