<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use JsValidator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Enums\UserType;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     */
    protected function redirectTo()
    {
        return route('story.create', ['step' => 2]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        // si ya está logueado lo muevo al paso 2 (escribir)
        // sin $step, para que me lo muestre como paso 1.
        if (Auth::guest()) {
            return view('auth.register');
        } else {
            return redirect()->route('story.create');
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, User::$rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $role = isset($data['role']) && $data['role'] != null ? $data['role'] : UserType::AUTHOR;

        // acá no va a caer porque valida antes lo mismo el JS
        // pero igual habría que atrapar los errores
        $this::validator($data)->validate();

        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $role
        ]);
    }
}
