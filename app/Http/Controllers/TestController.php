<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\User;
use Auth;

class TestController extends Controller
{
   
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

