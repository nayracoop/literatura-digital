<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use Auth;
use App\Models\Story;
use App\Models\TextNode;
use App\Models\Comment;
use App\User;

class UserController extends Controller
{
   
   /**
   * Perfil publico del usuario
   *
   */
   public function author($slug){
      return view('user.user')
        ->with('author', User::where('slug',$slug)->first() );

   }

  /**
   * Guardar comentario sobre el autor
   *
   */

    public function storeComment(Request $request, $slug){
      $user = Auth::user();
      $input = $request->all();
      $author =  User::where('slug',$slug)->first();
      $comment = new Comment( $input );
      
      $comment->user()->associate($user);

      $author->comments()->save($comment) ; 
      $author->save();

      return redirect()->back();
    }


    /**
   * Perfil del usuario logueado
   *
   */
   public function myProfile(){
      return view('user.profile')
        ->with('user', Auth::user() );

   }


}