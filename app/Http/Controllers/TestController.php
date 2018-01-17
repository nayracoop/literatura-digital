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

    public function storeXhrStory(Request $request)
    {
         $story = null;
         $s = null;
         $input = $request->all();
         $redirect = '';

        if ($request->has('id')) {
            $s =  Story::where('_id', $request->id)->orWhere('slug', $request->slug)->first();
            $a = $s->update($input);

        } else {
            $story = new Story();
            $s = $story->create($input);
            $s->author()->associate(Auth::user());
        }

        if ($request->has('tags')) {
            $s->unset('tags');
            foreach ($request->tags as $tag) {
                $tag = trim($tag);
                $t = Tag::where('_id', $tag)->orWhere('name', $tag)->first();

                if ($t  === null) {
                    $newTag =  Tag::create(['name' => $tag]);
               //$newTag->name = trim($tag);
                    $s->tags()->associate($newTag);
                } elseif ($s->tags->where('_id', $t->id)->first() === null) {
                    $s->tags()->associate($t);
                }
            }
        }

        $s->status = 'draft';
        $s->save();

        return response()->json([
        'author' => Auth::user()->_id,
        'slug' => $s->slug,'id' => $s->_id,
        'input' => $input,
        'redirect' => route('node.create', $s->_id)
        ]);
    }

    public function saveNodeXhr(Request $request)
    {
        $input = $request->all();
        $redirect = '';
        $action = '';
        $story = Story::where('_id', $request->story)->first();
        $node = null;
        if ($request->has('id')) {
             $node = $story->textNodes->where('_id', $request->id)->first();
             $n = $node->update($input);
             $story->textNodes()->save($node);
             $story->save();
             $action = 'updated';
             //$story->update();
        } else {
             $node = new TextNode($input);
            // $n = $newNode->create($input);
             $story->textNodes()->save($node);
             $story->save();
             $action = 'created';
        }

        return response()->json([
          'action' => $action,
          'id' => $node->_id,
          'input' => print_r($input)
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
