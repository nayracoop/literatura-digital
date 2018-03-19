<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Story;
use Request;

class TagController extends Controller
{
    public function index()
    {
        $stories = Story::all();
        $tags = [];
        
        foreach ($stories as $story) {
            $story_tags = $story->tags->all();

            foreach ($story_tags as $tag) {
                $tags[$tag->name] = $tag;
            }
        }

        return view('tags.index')
            ->with('tags', $tags);
    }

    public function toggleDeleted($id)
    {
        $tag = Tag::withTrashed()->find($id);
        $trashed = $tag->trashed();

        if ($trashed) {
            $tag->restore();
        } else {
            $tag->delete();
        }

        //y la busco en los stories por nombre
        $stories = Story::all();

        foreach ($stories as $story) {
            $story_tags = $story->tags->where('name', $tag->name);

            foreach ($story_tags as $tag) {
                if ($trashed) {
                    $tag->restore();
                } else {
                    $tag->delete();
                }
            }
        }

        if (Request::ajax()) {
            return response()->json(['status'=>'ok']);
        }
        return back();
    }
}
