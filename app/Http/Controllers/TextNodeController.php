<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use Auth;
use App\Models\Story;
use App\Models\TextNode;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Tag;
use App\Models\Enums\StoryStatus;
use Carbon\Carbon;
use App\Http\Requests\UploadPicture;
use View;

class TextNodeController extends Controller
{
    /**
     * nodes
     * perfil de autor muestra los nodos del relato
     *
     */
    public function index($story)
    {
        return view('textNodes.list')
            ->with('user', Auth::user())
            ->with('story', Story::where('_id', $story)->orWhere('slug', $story)->first());
    }

    /**
    * Get the requested Node
    *
    * @return Story
    */
    public function show($story, $showStory)
    {
        $showStory = Story::where('slug', $story)->first();

        return view('textNodes.show')
            ->with('story', $showStory)
            ->with('textNode', $showStory->textNodes->where('slug', $showStory)->first());
    }
    
    /**
     * Muestra el formulario para nuevos fragmentos (Node)
     */
    public function create($story)
    {
        return view('textNodes.create')
            ->with('story', Story::where('_id', $story)->orWhere('slug', $story)->first());
    }

    /**
    * saveNodeXhr
    *
    * Crea nuevo fragmento (TextNode) o actualiza los datos del fragmento (TextNode) indicado.
    * @param Request $request
    * @return Response  json
    */
    public function saveNodeXhr(Request $request)
    {
        $input = $request->all();
        $redirect = null;
        $action = '';
        $story = Story::where('_id', $request->story)->first();
        $node = null;
        if ($request->has('id')) {
            $node = $story->textNodes->where('_id', $request->id)->first();
            $n = $node->update($input);
            $story->textNodes()->save($node);
            $story->save();
            $action = 'updated';
            // $story->update();
        } else {
            $node = new TextNode($input);
            // $n = $newNode->create($input);
            $story->textNodes()->save($node);
            $story->save();
            $action = 'created';
            $redirect = route('nodes.index', $story->_id);
        }

        return response()->json([
            'action' => $action,
            'id' => $node->_id,
            'redirect' => $redirect
        ]);
    }
    
    /**
    *
    */
    public function edit($story, $textNode)
    {
        $myStory = Story::where('_id', $story)->orWhere('slug', $story)->first();
        $myTextNode = $myStory->textNodes->where('_id', $textNode)->first();

        if ($myTextNode === null) {
            $myTextNode = $myStory->textNodes->where('slug', $textNode)->first();
        }

        return view('textNodes.edit')
            ->with('user', Auth::user())
            ->with('story', $myStory)
            ->with('node', $myTextNode);
    }
}
