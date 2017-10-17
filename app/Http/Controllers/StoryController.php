<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use Auth;
use App\Models\Story;
use App\Models\TextNode;
use App\Models\Comment;

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
      
      if(  $request->hasFile('cover') && $request->file('cover')->isValid() ){

         $cover = date('Y/m/dHis').'.'.$request->cover->extension(); 
         $path = $request->cover->storeAs('',$cover, 'nayra');
         $input['cover'] = $cover;

      }

      //@todo validar slug   
      $s = $story->create($input);    
      
      $s->slug = str_slug( $s->title );
      $s->author()->associate($author);
      $s->save();

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

  /**
     * Muestra el formulario para nuevos fragmentos (Node)
     */
    public function createNode($slug)
    {
      return view('nodes.create_node')
        ->with('story',Story::where('slug', $slug)->first())
       ;
    }

     /**
     * Guarda un nuevo nodo en el relato indicado via slug
     */
    public function storeNode(Request $request,$slug)
    {
      $story = Story::where('slug', $slug)->first();
      $input = $request->all();

      $node = new \App\Models\TextNode($input);  

      //slug temporario si es guardar - para publicar debería estar referido al titulo
      if( $node->title !== '' && $node->title !== null ){
        $node->slug = str_slug($node->title);
      }else{
        $node->slug = str_slug( date('amdHIs') );
      }      
     
    //---
      $story->textNodes()->save($node) ;
    //  $n->save();
    //  echo 'Nodo '.$node->getIdAttribute();
      $story->save();
      return redirect()->route('story.show',$story->slug);    
    }



    public function storeComment(Request $request, $slug){
      $user = Auth::user();
      $input = $request->all();
      $story =  Story::where('slug',$slug)->first();
      $comment = new Comment( $input );
      
      $comment->user()->associate($user);

      $story->comments()->save($comment) ; 
      $story->save();

      return redirect()->back();
    }


}