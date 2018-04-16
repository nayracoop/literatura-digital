<?php

namespace App\Models;

use App\Models\BaseModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Lang;
use Auth;
use App\Models\Enums\Status;

class Story extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'status', 'slug', 'description',// 'typology', 'visualization',
        'genre', 'cover', 'type', 'attachment', 'published_at'
    ];

    protected $dates = [
        'published_at',
        'deleted_at'
    ];

    public static $rulesPublish = [
        'title' => 'required|max:128',
        'description' => 'required|max:512',
        'typology' => 'required',
        'genre' => 'required'
    ];

    public static $rules = [
        'title' => 'max:128',
        'description' => 'max:512',
        'typology' => 'required',
        'genre' => 'required'
    ];

    public static function getMessages()
    {
        return $messages = [
          'title.max' => Lang::get('messages.title.max', ['cant' => 128]),
          'description.max' => Lang::get('messages.description.max', ['cant' => 512]),
          'typology' => 'Este campo es obligatorio',
          'genre' => 'Este campo es obligatorio'
        ];
    }

    public function author()
    {
        return $this->belongsTo('\App\User');
    }

    public function textNodes()
    {
        return $this->embedsMany('\App\Models\TextNode');
    }

    public function comments()
    {
        return $this->embedsMany('\App\Models\Comment');
    }

    public function tags()
    {
        return $this->embedsMany('\App\Models\Tag');
    }

    public function likes()
    {
        return $this->embedsMany('\App\Models\Like');
    }

    public function visualization()
    {
        //return $this->hasOne('\App\Models\Visualization');
        return $this->belongsTo('\App\Models\Visualization');
    }

    public function typology()
    {
        return $this->belongsTo('\App\Models\Typology');
    }

   /**
   * Filtra los nodos, retornando solo publicados en la ruta publica
   **/
    public function textNodesPublished()
    {
      //  $textNodes = null;
        $published = \App\Models\Enums\Status::PUBLISHED;
        //if (\Route::currentRouteName() == 'story.show') {
            return  $this->textNodes->where('status', $published);
      //  } else {
        //    return $this->textNodes;
      //  }
    }

    /**
    * textNodesByDate retorna un array con los relatos separados por dia. Localiza y formatea la fecha
    * admite como parametro el mes y anho para filtrar
    * @param $mont
    * @param $year
    * @return array
    **/
    public function textNodesByDate($month = null, $year = null)
    {
        $calendar = [];
        // \Carbon\Carbon::setLocale('es');
        // \Carbon\Carbon::setUtf8(true);

        foreach ($this->textNodes->sortBy('created_at') as $node) {
            if ($month !== null && $year !== null) {
                if ($node->created_at->month == $month && $node->created_at->year == $year) {
                    $calendar[$node->created_at->formatLocalized('%A %d de %B %Y')][] = $node;
                }
            } else {
                $calendar[$node->created_at->formatLocalized('%A %d de %B %Y')][] = $node;
            }
        }

        return $calendar;
    }

    /**
    * getNextMonth   usados para calendario.Permite a partir de un nodo saber cual es el siguiente mes
    * con nodos
    * @param $mont, $year
    * @return Carbon or null
    *
    */
    public function getNextMonth($month, $year)
    {
        $currentMonth = \Carbon\Carbon::create($year, $month, 1);
        $nextMonth = \Carbon\Carbon::create($year, $month, 1)->addMonth()->firstOfMonth();
        $next = null;
        $nodes = $this->textNodes->where('created_at', '>=', $nextMonth)->sortByDesc('created_at');
        while ($next == null && $nodes->count() > 0) {
            $node = $nodes->pop();
            if ($node->created_at->month == $nextMonth->month) {
                // $calendar[$node->created_at->formatLocalized('%A %d de %B %Y')][] = $node;
                $next = $nextMonth;
            } else {
                $nextMonth = $nextMonth->addMonth()->firstOfMonth();
                $nodes = $this->textNodes->where('created_at', '>=', $nextMonth)->sortByDesc('created_at');
            }
        }
        return $next;
    }

    /**
    *
    * getPrevMonth  usados para calendario.Permite a partir de un nodo saber cual es el anterior mes
    * con nodos
    * @param nodeId
    * @return Carbon or null
    *
    */
    public function getPrevMonth($month, $year)
    {
        $currentMonth = \Carbon\Carbon::create($year, $month, 20);
        $prevMonth = $currentMonth->subMonth()->firstOfMonth();
        $prev = null;
        $nodes = $this->textNodes->where('created_at', '<=', $prevMonth)->sortByDesc('created_at');
        while ($prev == null && $nodes->count() > 0) {
            $node = $nodes->pop();
            if ($node->created_at->month == $prevMonth->month) {
            //  $calendar[$node->created_at->formatLocalized('%A %d de %B %Y')][] = $node;
                $prev = $prevMonth;
            } else {
                $prevMonth = $prevMonth->subMonth()->firstOfMonth();
                $nodes = $this->textNodes->where('created_at', '>=', $prevMonth)->sortByDesc('created_at');
            }
        }
        return $prev;
    }

    /**
    * scopeFeatured
    *
    * Nos da los relatos.
    *
    * @todo ordenados por valor de votacion
    * @author Jose Casanova <jose.casanova@nayra.coop>
    *
    * @param $count  cantidad de items a traer. Default 4
    *
    * @return Collection Story
    **/
    public function scopeFeatured($query, $count = 40)
    {
        if (Auth::check() && Auth::user()->isAdminOrMod()) {
            $stories = $query->get();
        } else {
            $stories = $query->where('status', Status::PUBLISHED)->take($count)->get();
        }
        return $stories;
    }

    /**
    * scopeGetFromAuthor
    *
    * Nos da los relatos pertenecientes al usuario solicitado.
    * @author Jose Casanova <jose.casanova@nayra.coop>
    *
    * @param $id
    *
    * @return Collection Story
    **/
    public function scopeGetFromAuthor($query, $id)
    {
        return $query->where('author_id', $id);
    }

    /**
    * scopeChoralVoices
    *
    * Si es relato coral devuelve las voces existentes.
    * @author Jose Casanova <jose.casanova@nayra.coop>
    *
    * @param $id
    *
    * @return Array
    **/
    public function choralVoices()
    {
        $voices = [];
        foreach ($this->textNodes->unique('voice') as $node) {
            $voices[] = $node->voice;
        }
        return $voices;
    }

    /**
    * scopeGetFromAuthor
    *
    * Nos da los relatos pertenecientes al tag solicitado.
    * @author Jose Casanova <jose.casanova@nayra.coop>
    *
    * @param $id
    *
    * @return Collection Story
    **/
    public function scopeGetFromTag($query, $tag)
    {
        return $query->where('tags.name', $tag);
    }

     /**
     * getAuthorName helper para nombre completo del autor
     * @return String
     */
    public function getAuthorName()
    {
        return $this->author->getName();
    }

    /**
    * countChars contamos el total de caracteres del relato
    * @return String
    */
    public function countChars()
    {
        $count = 0;
        foreach ($this->textNodes as $node) {
            $count += $node->charCount;
        }
        return $count;
    }


    /**
    * countLikes cantidad de me gusta
    *
    */
    public function countLikes()
    {
        return $this->likes->where('status', 'liked')->get()->count();
    }

    /**
    * getVisualization  facilita el objeto con clase Visualization a partir de refencian de id
    * @param id
    */
    public function getVisualization()
    {
        return $this->typology->visualizations()->find($this->visualization_id);
    }
}
