<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request as R;
use Flash;
use Auth;
use App\Models\Story as Story;
use App\Models\TextNode;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Tag;
use App\Models\Typology;
use App\Models\Enums\Status;
use Carbon\Carbon;
use App\Http\Requests\UploadPicture;
use View;
use Illuminate\Cookie\CookieJar;
use App\Utils\UserHistory;

class TextNodeController extends Controller
{
    /**
     * nodes
     * perfil de autor muestra los nodos del relato
     *
     */
    public function index($story)
    {
        $myStory = Story::where('_id', $story)->orWhere('slug', $story)->first();

        $typology = $myStory->typology;
      //  $visualization = $typology->visualizations()->find($myStory->visualization_id);

        return view('textNodes.list')
            ->with('user', Auth::user())
            ->with('story', $myStory)
            ->with('typology', $typology)
        //    ->with('visualization', $visualization);
        ;
    }

    /**
    * Get the requested Node
    *
    * @return Story
    */
    public function show(Request $request, CookieJar $cookieJar, $story, $showStory)
    {
        $story = Story::where('slug', $story)->first();

        $textNode = $story->textNodes->where('slug', $showStory)->first();
        /*
        if (Auth::check()) {
             UserHistory::addNode('user', $textNode, Auth::user());
              // var_dump(json_encode(Auth::user()->history, JSON_PRETTY_PRINT));
        } else {
             UserHistory::addNode('cookie', $textNode, $request, $cookieJar);
        }*/
        return view('textNodes.show')
            ->with('story', $story)
            ->with('textNode', $textNode);
    }

    /**
     * Muestra el formulario para nuevos fragmentos (Node)
     */
    public function create($story, $step = null)
    {
        return view('textNodes.create')
            ->with('story', Story::where('_id', $story)->orWhere('slug', $story)->first())
            ->with('step', $step);
    }

    public function togglePublished($id)
    {
        // cambiar fecha de publicación
        if (isset($id)) {
            $textNode = TextNode::withTrashed()->find($id);
            $status = $textNode->status();

            if ($status == Status::DRAFT) {
                $textNode->status = Status::PUBLISHED;
            } else {
                $textNode->status = Status::DRAFT;
            }

            $textNode->save();
        }

        if (R::ajax()) {
            return response()->json(['status'=>'ok']);
        }
        return back();
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

        $date = \App\Utils\Dates::getDateFromInput($input);

        if ($request->has('id')) {
            $node = $story->textNodes->where('_id', $request->id)->first();
            $node->node_date = $date;
            $n = $node->update($input);
            $story->textNodes()->save($node);
            $story->save();
            $action = 'updated';
        } else {
            $node = new TextNode($input);
            $node->node_date = $date;
            $story->textNodes()->save($node);
            $story->save();
            $action = 'created';
            $redirect = route('nodes.index', $story->_id);
        }
        //coral
        if ($request->has('new_voice') && $request->new_voice != '') {
            $node->voice = $request->new_voice;
        } elseif ($request->has('voice')) {
            $node->voice = $input['voice'];
        }

        $node->save();

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


    /**
    *  savePosition en visualizacion de 'palabras' guarda la posicion de un nodo
    *
    */
    public function savePosition(Request $request, $story)
    {
        $status = 'failed';
        $story = Story::where('_id', $story)->first();
        $node = $story->textNodes->where('_id', $request->nodeId)->first();
        if ($node !== null) {
            $node->positionX = $request->x;
            $node->positionY = $request->y;
            $node->save();
            $status = 'updated';
        }
        return response()->json([
          'status' => $status,
          'node' => $request->nodeId,

        ]);
    }

    /**
    * get buscamos un nodo y obtenemos un json
    * @return Response json
    */
    public function getJson(Request $request, $story)
    {
        $input = $request->all();
        $s = Story::where('_id', $story)->first();
        $node = $s->textNodes()->where('_id', $request->id)->first();

        return response()->json([
         'node' => $node,
      //    'id' => var_dump($input)
    //  //    'st' => ($s->textNodes()->first())
        ]);
    }
    /**
    *  getMonthCalendar
    *  @return json response
    */
    public function getMonthCalendar(Request $request, $slug)
    {
        $input = $request->all();
        $month = null;
        $year = null;
        if (isset($request->month) && isset($request->year)) {
            $month = $request->month;
            $year = $request->year;
        }

        $story = Story::where('_id', $slug)->orWhere('slug', $slug)->first();
      //  $monthNodes = $nodes;


        $calendar = \App\Utils\Dates::renderCalendar($story, $month, $year);
        return response()
          ->json([
              'month' => $month,
              'year' => $year,
            //  'next' => $next,
            //  'prev' => $prev,
            //  'textNodes' =>   $nodes,
              'calendar' => $calendar
          ]);
    }


    /**
    * saveHistory
    * @return Response json
    */
    public function saveHistory(Request $request, CookieJar $cookieJar, $story)
    {
        $status = '-';
        $story = Story::where('_id', $story)->first();
        $textNode = $story->textNodes->where('slug', $request->node)->first();
        if (Auth::check()) {
             UserHistory::addNode('user', $textNode, Auth::user());
             $status = 'added to user';
              // var_dump(json_encode(Auth::user()->history, JSON_PRETTY_PRINT));
        } else {
             UserHistory::addNode('cookie', $textNode, $request, $cookieJar);
             $status = 'updated history cookie';
        }

        return response()->json([
          'status' => $status
        ]);
    }
}
