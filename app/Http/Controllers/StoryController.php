<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    /**
     * Gets the list of Stories
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::all();
        return view('welcome')
        ->with('stories', $stories);
     }

}