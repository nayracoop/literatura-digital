<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\User;
use Auth;

class TestController extends Controller
{

  public function storeXhrStory(Request $request){

  }

  /**
   * 
   */
  public function storeXhrPicture(Request $request){
    $cover = '';
   // $input = $request->all();
   // print_r($input);
    if(  $request->hasFile('cover') && $request->file('cover')->isValid() ){
      
               $cover = date('Y/m/dHis').'.'.$request->cover->extension(); 
               $path = $request->cover->storeAs('',$cover, 'nayra');
           //    $input['cover'] = $cover;
      
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

