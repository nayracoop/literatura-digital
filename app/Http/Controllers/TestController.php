<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\User;
use Auth;

class TestController extends Controller
{

  public function storeXhrStory(Request $request){
      $story = null;$s = null;
      $input = $request->all();
      //echo 'fgd '.$input['slug'];
      if($request->has('slug') ){
        $s =  Story::where('_id',$request->slug)->orWhere('slug',$request->slug)->first();
        $a = $s->update( $input );
       // echo "g";
      }else{
        $story = new Story();
        $s = $story->create( $input );
        $s->author()->associate( Auth::user() );
      //  echo "new";
      }
   
           
      if( empty($s->title)   ){
          $s->slug = $s->getIdAttribute();
      }else{
          $s->slug = str_Slug($s->title);
      } 
      $s->save(); 

      return response()->json([
        'slug' => $s->slug, 'input' => $input
      ]);
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
  public function storeXhrPicture(Request $request, $story = null){
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

