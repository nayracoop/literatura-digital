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

class UserController extends Controller
{

    /**
     * XhrUpdateData
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $user->update($input);
        return redirect()->back();
    }

   /**
    * Perfil publico del usuario
    *
    */
    public function author($autor)
    {
        return view('user.user')
            ->with('author', User::where('username', $autor)->first());
    }

    /**
     * stories
     * seccion "mis relatos" del perfil de autor
     *
     */
    public function stories()
    {
        return view('user.stories')->with('user', Auth::user());
    }

    /**
     * nodes
     *  perfil de autor muestra los nodos del relato
     *
     */
    public function nodes($slug)
    {
        return view('user.nodes')
            ->with('user', Auth::user())
            ->with('story', Story::where('_id', $slug)->orWhere('slug', $slug)->first());
    }
/**
*
*/
    public function editNode($story, $node)
    {
        $story = Story::where('_id', $story)->orWhere('slug', $story)->first();
        $node = $story->textNodes->where('_id', $node)->first();
        if ($node === null) {
            $node = $story->textNodes->where('slug', $node)->first();
        }

        return view('nodes.create_node')
            ->with('user', Auth::user())
            ->with('story', $story)
            ->with('node', $node);
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
}
