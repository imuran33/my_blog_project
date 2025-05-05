<?php

namespace App\Http\Controllers;
use App\Post;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $latestPosts = Post::orderBy('created_at', 'desc')->take(5)->get(); // 最新5件

        return view('welcome', compact('latestPosts'));
    }
}