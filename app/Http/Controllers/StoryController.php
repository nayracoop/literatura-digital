<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as R;
use Flash;
use Auth;
use App\Models\Story;
use App\Models\TextNode;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Tag;
use App\Models\Enums\StoryStatus;
use App\Models\Enums\Typology;
use Carbon\Carbon;
use App\Http\Requests\UploadPicture;
use View;
use Illuminate\Cookie\CookieJar;
use App\Utils\UserHistory;

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
    * Obtenemos la historia correspondiente
    *
    */
    public function storiesByTag(Request $request, $tag)
    {
        $stories = Story::getFromTag($tag)->get();
        return view('home')
            ->with('stories', $stories);
    }


     /**
     * Get the requested Story
     *
     * @return Story
     */
    public function show(Request $request, CookieJar $cookieJar, $slug)
    {
        $story = Story::where('slug', $slug)->first();
        $story->views++;
        $story->save();

        if (Auth::check()) {
             UserHistory::addStory('user', $story, Auth::user());
        } else {
             UserHistory::addStory('cookie', $story, $request, $cookieJar);
          //var_dump(json_encode($request->cookie('history'), JSON_PRETTY_PRINT));
        }

        return view('stories.show')
            ->with('story', $story);
    }

    /**
     * stories
     * seccion "mis relatos" del perfil de autor
     *
     */
    public function list()
    {
        return view('stories.list')->with('user', Auth::user());
    }

     /**
     * Muestra el formulario para metadatos de relato
     */
    public function create($step = null)
    {
        return view('stories.create')
            ->with('step', $step);
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

    public function edit($story)
    {
        return view('stories.edit')
            ->with('story', Story::where('_id', $story)->orWhere('slug', $story)->first())
            ->with('typologies', Typology::values());
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
            $likeable->likes()->destroy($currentLike);
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
        $search = '';

        if ($request->has('search')) {
            $search = trim($input['search']);
        }
        if ($request->has('tag')) {
            $filter_tag = trim($input['tag']);
        }
        if ($request->has('genre')) {
            $genre = $input['genre'];
        }
        $stories = [];
        $tags = [];
        $results = '';

        $isAdminOrMod = false;

        if (Auth::check()) {
            $isAdminOrMod = Auth::user()->isAdminOrMod() ? true : false;
        }
        
        $query = Story::query();

        if (!$isAdminOrMod) {
            $query->where('status', StoryStatus::PUBLISHED);
        }

        if (isset($genre) && $genre != 'todos') {
            $query->where('genre', $genre);
        }

        if (isset($search) && $search != '') {
            $query = $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
                    //al nombre de los tags no le tiramos search
                    //porque se puede buscar por tag y porque los tags
                    //no están en el summary de la historia
                    //->orWhere('tags.name', 'like', "%$search%");
            });
        }

        if (isset($filter_tag) && $filter_tag != '') {
            $query = $query->where(function ($query) use ($filter_tag) {
                $query->where('tags.name', 'like', "%$filter_tag%");
            });
        }

        $stories = $query->orderBy('created_at')->get();

        foreach ($stories as $story) {
            $story_tags = $story->tags->all();

            foreach ($story_tags as $tag) {
                $tags[$tag->name] = $tag;
            }
        }

        if (R::ajax()) {
            $storiesRender = View::make('stories.block_list')
                ->with('stories', $stories)
                ->with('title', $search)
                ->render();

            return response()->json(['stories' => $storiesRender,
                                    'search' => $search,
                                    'tags' => $tags]);
        }

        //por ahora no se llama esta función sin ajax
        return false;
    }

    /**
     * SearchByGenre
     *
     * xhttp function
     */
    public function searchByGenre($genre = null)
    {
        $stories = [];
        $tags = [];
        $results = '';
        $isAdminOrMod = false;
        
        if (Auth::check()) {
            $isAdminOrMod = Auth::user()->isAdminOrMod() ? true : false;
        }
        
        $query = Story::query();

        if (!$isAdminOrMod) {
            $query->where('status', StoryStatus::PUBLISHED);
        }

        if (isset($genre)) {
            // le meto título dependiendo de que esté definido el género o no
            $query->where('genre', $genre);
            $title = $genre;
        } else {
            $title = 'Todos';
        }
        
        $stories = $query->orderBy('created_at')->get();

        foreach ($stories as $story) {
            $story_tags = $story->tags->all();

            foreach ($story_tags as $tag) {
                $tags[$tag->name] = $tag;
            }
        }

        if (R::ajax()) {
            $results = View::make('stories.block_list')
                ->with('stories', $stories)
                ->with('title', $genre)
                ->render();

            return response()->json(['genre'=>$search, 'results' => $results]);
        }
            
        return view('stories.genre')
            ->with('stories', $stories)
            ->with('tags', $tags)
            ->with('title', $title)
            ->with('genre', $genre);
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
            $s = Story::where('_id', $request->id)->first();
            $a = $s->update($input);
            $action = 'updated';
            $redirect = route('nodes.index', $s->getIdAttribute());
        } else {
            $story = new Story();
            $s = $story->create($input);
            $s->author()->associate(Auth::user());
            $action = 'created';
            $redirect = route('node.create', $s->getIdAttribute());
        }
        //guarda etiquetas como camelcase
        if ($request->has('tags')) {
            $s->unset('tags');
            foreach ($request->tags as $tag) {
                $tag = camel_case($tag);
                if ($s->tags->where('name', $tag)->first() === null) {
                     $s->tags()->create(['name' => $tag]);
                }
            }
        }
        $s->save();

        return response()->json([
            'author' => Auth::user()->_id,
            'id' => $s->getIdAttribute(),
            'input' => $input,
            'redirect' => $redirect,
            'action' => $action
            ]);
    }

    /**
    * storePictureXhr
    * Guarda foto y si existe la asocia al relato
    */
    public function storePictureXhr(UploadPicture $request, $story = null)
    {
        $cover = '';
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $cover = date('Y/m/dHis') . '.' . $request->cover->extension();
            $path = $request->cover->storeAs('', $cover, 'nayra');
        }
        if ($story != null) {
            $s = Story::where('_id', $story)->orWhere('slug', $story)->first();
            $s->cover = $cover;
            $s->save();
        }

        return response()->json([
            'picUrl' => url('imagenes/cover/' . $cover),
            'picName' => $cover
        ]);
    }

    /**
    *  saveColor
    *
    */
    public function saveColor(Request $request, $id)
    {
        $status = 'failed';
        $story = Story::where('_id', $id)->orWhere('slug', $id)->first();
        if ($story !== null) {
            $story->color = $request->color;
            $story->save();
            $status = 'updated';
        }

        return response()->json([
              'status' => $status,
              'color' => $request->color
          ]);
    }
}
