<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function destroy(Request $request)
    {
        $user = Auth::user();

        /** @var \App\Models\User $user */
        Auth::logout(); // ログアウト
        $user->delete(); // ユーザー削除

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', '退会処理が完了しました。<br>ご利用ありがとうございました。');
    }
}
