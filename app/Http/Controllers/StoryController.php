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
use View;

class StoryController extends Controller
{
    /**
     * Gets the list of Stories
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::featured();
        return view('home')
            ->with('stories', $stories);
    }


     /**
     * Relatos
     *
     * @return \Illuminate\Http\Response
     */
    public function stories(Request $request)
    {
        $search = trim($request->search);

        if ($request->has('search')) {
            $stories = Story::where('title', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%")
                            ->get();
        } else {
            $stories = Story::featured();
        }

        return view('stories.stories')
            ->with('stories', $stories);
    }

     /**
     * Get the requested Story
     *
     * @return Story
     */
    public function show($slug)
    {
        $story = Story::where('slug', $slug)->first();
        $story->views++;
        $story->save();

        return view('stories.story')
            ->with('story', $story);
    }

     /**
     * Muestra el formulario para metadatos de relato
     */
    public function createStory()
    {
        return view('stories.create_story');
    }

     /**
     * Guarda la informacion del relato asociado a un usuario
     */
    public function storeStory(Request $request)
    {
        $author = Auth::user();
        $input = $request->all();
        $story =  new \App\Models\Story();

        //imagen de portada
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $cover = date('Y/m/dHis').'.'.$request->cover->extension();
            $path = $request->cover->storeAs('', $cover, 'nayra');
            $input['cover'] = $cover;
        }

        //titulo
        if (empty($input['title'])) {
            $input['title'] = 'borrador-'.date('dmYHis');
        }

        //@todo validar slug
        $s = $story->create($input);

        // publicar o borrador
        if ($request->has('draft')) {
            $s->status = StoryStatus::DRAFT;
        } else {
            $s->status = StoryStatus::PUBLISHED;
        }

        $s->slug = str_slug($s->title);
        $s->author()->associate($author);
        $s->save();

        return redirect()->back();
    }

    public function editStory($slug)
    {
        return view('stories.create_story')->with('story', Story::where('_id', $slug)->orWhere('slug', $slug)->first());
    }

    public function updateStory(Request $request, $slug)
    {
        $input = $request->all();
        $story = Story::where('slug', $slug)->first();
        print_r($story);

        //imagen de portada
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $cover = date('Y/m/dHis').'.'.$request->cover->extension();
            $path = $request->cover->storeAs('', $cover, 'nayra');
            $input['cover'] = $cover;
        }

        //titulo
        if (empty($input['title'])) {
            $input['title'] = 'borrador-'.date('dmYHis');
        }
        // print_r($input);

        // @todo validar slug
        $s = $story->update($input);

        // publicar o borrador
        if ($request->has('draft')) {
            $story->status = StoryStatus::DRAFT;
        } else {
            $story->status = StoryStatus::PUBLISHED;
        }

        $story->slug = str_slug($story->title);
        // $s->author()->associate($author);
        $story->save();
        return redirect()->back();
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
            ->with('textNode', $story->textNodes->where('slug', $slugNode)->first());
    }

    /**
     * Muestra el formulario para nuevos fragmentos (Node)
     */
    public function createNode($slug)
    {
        return view('nodes.create_node')
            ->with('story', Story::where('_id', $slug)->orWhere('slug', $slug)->first());
    }

     /**
     * Guarda un nuevo nodo en el relato indicado via slug
     */
    public function storeNode(Request $request, $slug)
    {
        $story = Story::where('slug', $slug)->first();
        $input = $request->all();

        $node = new \App\Models\TextNode($input);

        //slug temporario si es guardar - para publicar debería estar referido al titulo
        if ($node->title !== '' && $node->title !== null) {
            $node->slug = str_slug($node->title);
        } else {
            $node->slug = str_slug(date('amdHIs'));
        }

        if (!isset($input['published_at'])) {
            $node->published_at = Carbon::now();
        } else {
            $date = str_replace('/', '-', $input['published_at']);
            $node->published_at = date('Y-m-d H:i:s', strtotime($date));
        }

        //coral
        if ($request->has('new_voice') && $request->new_voice != '') {
            $node->voice = $request->new_voice;
        } elseif ($request->has('voice')) {
            $node->voice = $input['voice'];
        }

        // publicar o borrador
        if ($request->has('draft')) {
            $node->status = StoryStatus::DRAFT;
        } else {
            $node->status = StoryStatus::PUBLISHED;
        }

        $story->textNodes()->save($node);
        $story->save();
        return redirect()->route('story.show', $story->slug);
    }

    public function storeComment(Request $request, $slug)
    {
        $user = Auth::user();
        $input = $request->all();
        $story =  Story::where('slug', $slug)->first();
        $comment = new Comment($input);

        $comment->user()->associate($user);
        $story->comments()->save($comment) ;
        $story->save();

        return redirect()->back();
    }

    /**
     * Seguir historia - nodo
     * @return json con status
     *
     */
    public function like($story, $node = null)
    {
        $likeable = Story::where('slug', $story)->first();

        if ($node != null) {
            $likeable = $likeable->textNodes->where('slug', $node)->first();
        }

        //echo $likeable;
        $me = Auth::user();
        //cosa estranha che---
        //echo $lik;
        $currentLike = $likeable->likes->where('user_id', $me->getIdAttribute())->first();

        if ($currentLike !== null) {
            $likeable->likes()->destroy($currentLike) ;
        } else {
            $like = new Like();
            $like->user()->associate($me);

            $likeable->likes()->save($like);
        }

        return response()->json(['status' => 'ok']);
    }

    public function search(Request $request)
    {
        $input = $request->all();
        $search = trim($input['search']);
        $stories = [];
        $tags = [];

        if ($request->has('search')) {
            $stories = Story::where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('tags.name', 'like', "%$search%")->where('status', StoryStatus::PUBLISHED)->get();

            $tags = Tag::where('name', 'like', "%$search%")->get();
        } else {
            $stories = Story::featured();
        }

        $results = View::make('snippets.featured_stories')->with('stories', $stories)->render();

        return response()->json(['search' => $search,
                                'results' => $results,
                                'tags' => $tags]);
    }

    /**
     * SearchByGenre
     *
     * xhttp function
     */
    public function searchByGenre(Request $request)
    {
        $input = $request->all();
        $search = null;
        if ($request->has('genre')) {
            $search = $input['genre'];
        }
        $stories = [];
        $results = '';
        $isAdminOrMod = 'false';

        if (Auth::check()) {
            $isAdminOrMod = Auth::user()->isAdminOrMod() ? 'true' : 'false';
        }
        
        if (isset($search)) {
            if ($search == 'todos') {
                $stories = Story::where('status', StoryStatus::PUBLISHED)
                                ->orWhere($isAdminOrMod)
                                ->orderBy('created_at')
                                ->get();
            } else {
                $stories = Story::where('genre', 'like', "%$search%")
                                ->where(function ($query) use ($isAdminOrMod) {
                                    $query->where('status', StoryStatus::PUBLISHED)
                                          ->orWhere($isAdminOrMod);
                                })
                                ->orderBy('created_at')
                                ->get();
            }
        } else {
            $stories = Story::featured();
        }

        $results = View::make('stories.list')
                        ->with('stories', $stories)
                        ->render();

        return response()->json(['genre'=>$search, 'results' => $results]);
    }

    /**
     * changeStatus
     *
     * xhttp function
     */
    public function changeStatus(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        $results = '';
        $story = null;
        $isAdminOrMod = false;

        if (Auth::check()) {
            $isAdminOrMod = Auth::user()->isAdminOrMod();
        }
        
        if ($isAdminOrMod) {
            $story = Story::find($id);
            if ($story->status == StoryStatus::PUBLISHED) {
                $story->status = StoryStatus::DRAFT;
            } else {
                $story->status = StoryStatus::PUBLISHED;
            }
            $story->save();
            $results = 'Success';
        } else {
            $results = 'Access denied';
        }

        return response()->json(['id'=>$id, 'results' => $results]);
    }

    /**
     * genre
     *
     * xhttp function
     */
    public function genre($genre)
    {
        $stories = [];
        $tags = [];
        if ($request->has('genre')) {
            $stories = Story::where('genre', 'like', "%$genre%")
                            ->where('status', 'publish')
                            ->get();
        } else {
            // $stories = Story::featured();
        }
        $results = View::make('stories.list')
                        ->with('stories', $stories)
                        ->render();

        return response()->json(['genre'=>$input['genre'], 'results' => $results]);
    }

    /**
    * saveStoryXhr
    *
    * Crea nuevo relato o actualiza los datos del relato indicado.
    * @param Request $request
    * @return Response  json
    */
    public function saveStoryXhr(Request $request)
    {
           $story = null;
           $s = null;
           $input = $request->all();
           $redirect = '';
           $action = '';

        if ($request->has('id')) {
              $s =  Story::where('_id', $request->id)->first();
              $a = $s->update($input);
              $action = 'updated';
        } else {
              $story = new Story();
              $s = $story->create($input);
              $s->author()->associate(Auth::user());
              $action = 'created';
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

        $s->save();

        return response()->json([
            'author' => Auth::user()->_id,
            'id' => $s->getIdAttribute(),
            'input' => $input,
            'redirect' => route('node.create', $s->getIdAttribute()),
            'action' => $action
            ]);
    }
    /**
    * saveStoryXhr
    *
    * Crea nuevo relato o actualiza los datos del relato indicado.
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
                 //$story->update();
        } else {
                 $node = new TextNode($input);
                // $n = $newNode->create($input);
                 $story->textNodes()->save($node);
                 $story->save();
                 $action = 'created';
                 $redirect = route('author.story.nodes', $story->_id);
        }

        return response()->json([
              'action' => $action,
              'id' => $node->_id,
              'redirect' => $redirect
            ]);
    }
}
