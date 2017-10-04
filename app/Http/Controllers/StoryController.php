<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * Get the requested Storiy
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
     * Get the requested Storiy
     *
     * @return Story
     */
    public function showNode($slug,$slugNode)
    {
        //
       $story = Story::where('slug', $slug)->first();

       //print_r($story);
       return view('nodes.node')
       ->with('story', $story)
       ->with('textNode', $story->textNodes->where('slug', $slugNode)->first()  );
     }

}