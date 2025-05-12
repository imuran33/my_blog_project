<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('public/images');
            $url = Storage::url($path);
            return response()->json(['url' => $url], 200);
        }
    
        return response()->json(['error' => 'ファイルがありません'], 400);
    }
}
