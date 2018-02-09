<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Story;
use App\Http\Requests\DeleteTag;

class TagController extends Controller
{
    public function index()
    {
        //$data = Story::project(['tags' => ['$slice' => 1]])->get();
        // $data = Story::distinct('tags')->get();
        /* ->raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$group'    => [
                        '_id'   => '$tags.name',
                        'count' => [
                            '$sum'  => 1
                        ]
                    ]
                ]
            ]);
        }); */

        $thedata = Story::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$unwind' => '$tags'
                ],
                [
                    '$group'    => [
                        '_id'   => '$tags.name',
                        'count' => [
                            '$sum'  => 1
                        ]
                    ]
                    
                ]
            ]);
        });

        var_dump($thedata);

        print_r($thedata[1]->count);
        print_r($thedata[1]->_id);

        //print_r($thedata);
        
        if (!isset($thedata['result'])) {
            // throw new UnexpectedValueException('Error in the query');
        }
        //$tags = Tag::hydrate($data['result']);

        // $tags = Story::project(['tags'])->get();

        /* return view('tags.index')
            ->with('tags', $data); */
    }
}
