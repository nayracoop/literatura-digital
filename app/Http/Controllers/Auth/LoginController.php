<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
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
     */
    protected function redirectTo()
    {
        if (Auth::user()->isAdminOrMod()) {
            return route('index');
        } else {
            return route('stories.list');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    /**
    * postLogin
    */
    public function postLogin(Request $request)
    {
        $auth = false;
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $auth = true; // Success
        }

        if ($request->ajax()) {
            return response()->json([
                'auth' => $auth,
                'intended' => URL::previous()
            ]);
        } else {
            return redirect()->intended(URL::route('index'));
        }
        return redirect(URL::route('index'));
    }
}
