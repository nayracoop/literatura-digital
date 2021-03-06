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
use App\Models\Typology;
use App\Models\Enums\Status;
use Carbon\Carbon;
use App\Http\Requests\UploadPicture;
use App\Http\Requests\StoreComment;
use View;
use Lang;
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
             $history = Auth::user()->history;
        } else {
             UserHistory::addStory('cookie', $story, $request, $cookieJar);
             $history = $request->cookie('history');
             //var_dump(json_encode($request->cookie('history'), JSON_PRETTY_PRINT));
        }

        return view('stories.show')
            ->with('story', $story)
            ->with('history', $history)
            ;
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
        //paso todas las tipologías
        //y las visualizaciones asociadas a la primer tipología
        $typologies = Typology::all();
        $visualizations = Typology::first()->visualizations;

        //muestro el resto de las visuzalizaciones a partir del onChange de tipologías en el formulario.
        return view('stories.create')
            ->with('step', $step)
            ->with('typologies', $typologies)
            ->with('visualizations', $visualizations);
    }

     /**
     * Guarda la informacion del relato asociado a un usuario
     */
    public function storeStory(Request $request)
    {
        $input = $request->all();

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
        $s = Story::create($input);

        // publicar o borrador
        if ($request->has('draft')) {
            $s->status = Status::DRAFT;
        } else {
            $s->status = Status::PUBLISHED;
        }

        $author = Auth::user();
        $typology = Typology::find($input['typology']);
        $visualization = $typology->visualizations()::find($input['visualization']);

        $s->slug = str_slug($s->title);
        $s->author()->associate($author);
        $s->typology()->save($typology);
        $s->visualization()->save($visualization);
        $s->save();

        return redirect()->back();
    }

    public function edit($story)
    {
        $myStory = Story::where('_id', $story)->orWhere('slug', $story)->first();
        //  $typologies = Typology::all();
        //$typologies = Typology::where($myStory->typology->getIdAttribute())->get();
        $typologies = [$myStory->typology];
        $visualizations = $myStory->typology->visualizations;

        return view('stories.edit')
            ->with('story', $myStory)
            ->with('typologies', $typologies)
            ->with('visualizations', $visualizations);
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
            $story->status = Status::DRAFT;
        } else {
            $story->status = Status::PUBLISHED;
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
        if ($request->has('new_voice') && trim($request->new_voice) != '') {
            $node->voice = $request->new_voice;
        } elseif ($request->has('voice')) {
            $node->voice = $input['voice'];
        }

        // publicar o borrador
        if ($request->has('draft')) {
            $node->status = Status::DRAFT;
        } else {
            $node->status = Status::PUBLISHED;
        }

        $story->textNodes()->save($node);
        $story->save();
        return redirect()->route('story.show', $story->slug);
    }

    public function storeComment(StoreComment $request, $slug)
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
        $likeable = Story::where('_id', $story)->first();
        $status = null;
        if ($node != null) {
            $likeable = $likeable->textNodes->where('_id', $node)->first();
        }

        //echo $likeable;
        $me = Auth::user();
        //cosa estranha che---
        //echo $lik;
        $currentLike = $likeable->likes->where('user_id', $me->getIdAttribute())->first();

        if ($currentLike !== null) {
            //  $likeable->likes()->destroy($currentLike);
            //$likeable->likes()->where('_id', $currentLike)->forceDelete();
            $a = $likeable->likes->find($currentLike->_id);
            $status = $a->status === 'liked' ?'unliked':'liked';
            $a->status = $status;
            $a->save();
            /*
            if (!isset($currentLike->deleted_at) || $currentLike->deleted_at == null) {
                $a->delete();
                $status = 'unliked';
            } else {
                $a->restore();
                $status = 'liked';
            }*/
            //*/
          //  $status = $a->status === 'liked' ?'unliked':'liked';
          //  $a->save();
        } else {
            $like = new Like(['status' => 'liked']);
            $like->user()->associate($me);

            $likeable->likes()->save($like);
            $status = 'liked';
        }

        return response()->json([
          'status' => $status,
          'o' => $likeable->likes->count()
        ]);
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
            $query->where('status', Status::PUBLISHED);
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
            $query->where('status', Status::PUBLISHED);
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
            if ($story->status == Status::PUBLISHED) {
                $story->status = Status::DRAFT;
            } else {
                $story->status = Status::PUBLISHED;
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
       //print_r($request->all());

        $story = null;
        $s = null;
        $title = null;
        $input = $request->all();
        $author = Auth::user();
        $redirect = '';
        $action = '';
        $oldTitle = '';

        if ($request->has('story') && !empty($request->story)) {
            $story = Story::where('_id', $request->story)->first();
            $oldTitle = $story->title;
            // este "$a" no lo uso para nada
            $a = $story->update($input);
            $action = 'updated';
        } else {
            $story = Story::create($input);
            $story->author()->associate($author);
            $action = 'created';
        }

        if ($request->has('typology')) {
            $typology = Typology::find($input['typology']);
            if ($request->has('visualization')) {
                $visualization = $typology->visualizations()->find($input['visualization']);
            } else {
                $visualization = $typology->visualizations()->first(); // si no esta definida la visualizacion se elige la primera
            }
            //guardo la tipología y la visualización asociada al relato
            //$story->typology()->save($typology);
            $story->typology()->associate($typology);
            $story->visualization()->associate($visualization);
        }
        //guarda etiquetas como camelcase
        $story->unset('tags');
        if ($request->has('tags')) {
            foreach ($request->tags as $tag) {
                $tag = camel_case($tag);
                if ($story->tags->where('name', $tag)->first() === null) {
                    $story->tags()->create(['name' => $tag]);
                }
            }
        }
        //slug
        $slugValidator = new \App\Utils\SlugValidator();
        //solo le creo un nuevo slug si el título cambió
        if ($oldTitle !== $story->title) {
            if (empty($story->title) || $story->title === null) {
                $story->slug = $slugValidator->createSlug(Lang::get('messages.untitled'));
            } else {
                $story->slug = $slugValidator->createSlug($story->title);
            }
        }

        $step = 0;
        if ($request->has('step')) {
            $step = $request->step;
        }

        if ($oldTitle !== null && $action == 'updated' && $oldTitle !== $story->title) {
            $redirect = route('story.edit', $story->slug);
        } elseif ($action == 'created') {
            //le agrego el step, que viene de esta especie de wizard
            $redirect = route('node.create', [ 'story' => $story->slug, 'step' => ++$step ]);
        }

        //status
        if (!isset($story->status) || $story->status === null) {
          //  $story->status = StoryStatus::DRAFT;
        }

        $story->save();

        return response()->json([
            'author' => $author->_id,
            'id' => $story->getIdAttribute(),
            'input' => $input,
            'redirect' => $redirect,
            'action' => $action,
            // 'debug' =>  $s->title.' --- '.  $title
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



    /**
    *
    */
    public function validateSlug(Request $request)
    {
         $slugValidator = new \App\Utils\SlugValidator();
         $slug = $slugValidator->createSlug($request->slug);
         return response()->json([
              'slug' => $slug
         ]);
    }
}
