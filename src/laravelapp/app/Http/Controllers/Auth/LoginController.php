<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //ログインしたユーザーにあいさつ
    protected function authenticated(Request $request, $user)
    {
        $greeting = $this->getGreeting(); // あいさつ取得
        session()->flash('status', "{$user->name}さん、{$greeting}");
        return redirect()->intended($this->redirectPath());
    }

    // 挨拶を時間帯で返す
    private function getGreeting()
    {
        $hour = now()->hour;

        if ($hour >= 4 && $hour < 12) {
            return 'おはようございます！';
        } elseif ($hour >= 12 && $hour < 18) {
            return 'こんにちは！';
        } else {
            return 'こんばんは！';
        }
    }
}
