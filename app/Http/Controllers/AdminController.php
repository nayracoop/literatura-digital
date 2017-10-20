<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Flash;

class AdminController extends Controller
{
    //
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

	public function listUsers($filter = null){
		return view('admin.users')
			->with('users', User::where('*')->orderBy('role')->get()  )
		;
	}

}
