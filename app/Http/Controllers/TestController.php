<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadPicture;
use App\Models\Story;
use App\Models\TextNode;
use App\Models\Tag;
use App\User;
use Auth;

class TestController extends Controller
{

  public function tagList(Request $request){
     return response()->json();

  }

  public function updateXhrStory(Request $request, $slug){
    $input = $request->all();
    $story = Story::where('slug',$slug)->first();
    $story->update($input);
  //  extract($input);
    $editedField = $input['field'];

    return response()->json([
     'slug' => $story->title, 'input' => $input[ $editedField ], 'field' => $input['field']
    ]);
}


  /**
   * storeXhrPicture
   * Guarda foto y si existe la asocia al relato
   */
  public function storeXhrPicture(UploadPicture $request, $story = null){
    $cover = '';
    if(  $request->hasFile('cover') && $request->file('cover')->isValid() ){
               $cover = date('Y/m/dHis').'.'.$request->cover->extension();
               $path = $request->cover->storeAs('',$cover, 'nayra');
    }

    if($story != null){
      $s = Story::where('_id',$story)->orWhere('slug',$story)->first();
      $s->cover = $cover;
      $s->save();
    }
    return response()->json([
      'picUrl' => url('imagenes/cover/'.$cover),'picName' => $cover
    ]);
  }

  /**
   *
   */
  public function searchXhr(Request $request){

  }



  /**
   *
   */
   public function deleteUser(){
   	$user = User::where('email','jose@gmail.com')->first();
	$user->delete();
   }


   public function listUsers(){
  	 foreach (User::all() as $user ) {
    	echo "<br> $user->email";
   	 }

   }


    public function listUserStories(){
     foreach (Auth::user()->getStories() as $story ) {
      echo "<br> $story->title";
      // print_r($story);
       echo "<br>";
     }



   }



}
