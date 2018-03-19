<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use Auth;
use Hash;
use App\Models\Story;
use App\Models\TextNode;
use App\Models\Comment;
use App\Models\Like;
use App\User;
use App\Http\Requests\CreateUser;
use App\Http\Requests\EditUser;
use App\Http\Requests\EditPassword;

class UserController extends Controller
{

    /**
     * XhrUpdateData
     */
    public function update(EditUser $request, $userId = null)
    {
        if (isset($userId)) {
            $user = User::find($userId);
        } else {
            $user = Auth::user();
        }

        $input = $request->all();
        $user->update($input);

        return redirect()->back();
    }

   /**
    * Perfil publico del usuario
    *
    */
    public function show($user)
    {
        $myUser = User::where('username', $user)->first();
        $me = Auth::user();
        $isOwner = false;

        if ($myUser->id === $me->id) {
            $isOwner = true;
        }

        return view('users.show')
            ->with('user', $myUser)
            ->with('isOwner', $isOwner);
    }

    /**
     * Guardar comentario sobre el autor
     *
     */
    public function storeComment(Request $request, $slug)
    {
        $user = Auth::user();
        $input = $request->all();
        $author =  User::where('slug', $slug)->first();
        $comment = new Comment($input);

        $comment->user()->associate($user);

        $author->comments()->save($comment) ;
        $author->save();

        return redirect()->back();
    }

    /**
     * Perfil del usuario logueado
     *
     */
    public function myProfile()
    {
        return view('user.profile')
            ->with('user', Auth::user());
    }

    /**
     * Seguir usuario
     * @return json con status
     *
     */
    public function follow($username)
    {
        $follow = User::where('username', $username)->first();
        $me = Auth::user();

        $like = new Like();

        return json(['status' => 'ok']);
    }

    public function index($filter = null)
    {
        return view('users.index')
            ->with('users', User::orderBy('role')->orderBy('created_at', 'desc')->get());
    }

    /**
     * Perfil del usuario a modificar
     *
     */
    public function edit($userId = null)
    {
        if (isset($userId)) {
            $user = User::find($userId);
        } else {
            $user = Auth::user();
        }

        return view('users.edit')
            ->with('user', $user);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(CreateUser $request)
    {
        User::create($request->all());
        return redirect()->back();
    }

    /**
    * passwordEdit vista para cambiar pass
    *
    */
    public function passwordEdit($userId = null)
    {
        if (isset($userId)) {
            $user = User::find($userId);
        } else {
            $user = Auth::user();
        }

        return view('users.password-edit')
            ->with('user', $user);
    }


    /**
    * passwordUpdate actualiza nuevo password con pedido de confirmacion
    *
    */
    public function passwordUpdate(EditPassword $request, $userId = null)
    {
        $input = $request->all();
        if (isset($userId)) {
            $user = User::find($userId);
        } else {
            $user = Auth::user();
        }
        $input['password'] = \Hash::make($input['password']);
        $user->update($input);

        return redirect()->route('user.edit');
    }
}
