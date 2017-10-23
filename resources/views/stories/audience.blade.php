<ul class="audiencia">
   <li><span class="sr-only">@lang('Visto'): </span><a href="#">{{ $story->views }}</a></li>
   <li><span class="sr-only">@lang('Likeado'): </span><a href="#">{{ $story->likes->where('deleted_at',null)->count() }}</a></li>
   <li><span class="sr-only">Comentarios: </span><a href="#">{{ $story->comments->count() }}</a></li>
</ul>   