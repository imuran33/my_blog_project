<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;

class FavoriteController extends Controller
{
    public function store($id)
    {
        $post = Post::findOrFail($id);

        // すでにいいねしていなければ追加
        if (!Auth::user()->hasFavorited($id)) {
            Auth::user()->favorite($id);
        }

        return back();
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // すでにいいねしていれば削除
        if (Auth::user()->hasFavorited($id)) {
            Auth::user()->unfavorite($id);
        }

        return back();
    }
}
