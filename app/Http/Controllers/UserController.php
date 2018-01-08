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

  public function updateProfile(Request $request){
    $user = Auth::user();
    $input = $request->all();
    $user->update($input);
   // $user->password = Hash::make($input['password']);
    return redirect()->back();
  //  return response()->json('status' => 'ok', 'input', );
  }

   /**
   * Perfil publico del usuario
   *
   */
   public function author($slug){
      return view('user.user')
        ->with('author', User::where('slug',$slug)->first() );

   }

  /**
   * stories
   * seccion "mis relatos" del perfil de autor
   *
   */
  public function stories(){
    return view('user.stories')
      ->with('user',Auth::user() );

 }

 /**
  * stories
  * seccion "mis relatos" del perfil de autor
  *
  */
 public function nodes($slug){
   return view('user.nodes')
     ->with('user',Auth::user() )
     ->with('story',Story::where('slug',$slug)->first());

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


    /**
   * Seguir usuario
   * @return json con status
   *
   */
   public function follow($username){

      $follow = User::where('username',$username)->first();
      $me = Auth::user();

      $like = new Like();

      return json( ['status' => 'ok'] );

   }


}
