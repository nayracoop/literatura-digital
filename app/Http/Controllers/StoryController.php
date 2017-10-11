<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use Auth;
use App\Models\Story;
use App\Models\TextNode;

class StoryController extends Controller
{
    /**
     * Gets the list of Stories
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stories = Story::moreVoted();
        return view('home')
        ->with('stories', $stories);
     }

     /**
     * Get the requested Story
     *
     * @return Story
     */
    public function show($slug)
    {
        //
       $story = Story::where('slug', $slug)->first();
       $story->views ++;
       $story->save();
       //print_r($story);
       return view('stories.story')
       ->with('story', $story);
     }

     /**
     * Muestra el formulario para metadatos de relato
     */
    public function createStory()
    {
      return view('stories.create_story')
       ;
    }

     /**
     * Guarda la informacion del relato asociado a un usuario
     */
    public function storeStory(Request $request)
    {
      
      $author = Auth::user();
      $input = $request->all();
      $story =  new \App\Models\Story();
     
      //@todo validar slug   
      $s = $story->create($input);
     // echo "ss $story->title";
      //$story->save();
      $s->slug = str_slug( $s->title );
      $s->author()->associate($author);
      $s->save();
      print_r($s);

      //return redirect()->back();
    
    }


    /**
     * Get the requested Story
     *
     * @return Story
     */
    public function showNode($slug, $slugNode)
    {
       $story = Story::where('slug', $slug)->first();       
       return view('nodes.node')
       ->with('story', $story)
       ->with('textNode', $story->textNodes->where('slug', $slugNode)->first()  );
     }




}