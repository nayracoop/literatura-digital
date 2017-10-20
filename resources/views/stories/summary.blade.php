  <div class="thumbnail">
    <div class="caption">
      <div class="media-item">
        @if(  $story->cover != null && !empty($story->cover)  )
        <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}">        
        @else
        <img alt="" src="{{ asset('img/tapa150x200.png')}}"> 
        @endif
      </div>
      <h3>{{$story->title}}</h3>
      <p class="lead">@lang('De') <a href="{{ route('author.show', $story->author->slug) }}">{{ $story->getAuthorName() }}</a></p>
      <p>{{ $story->description }}</p>

      <a href="#">{{$story->genre}}</a>
      <div>
        @if($story->views > 0)
          <span>@lang('Visto'): {{ $story->views }}</span>
        @endif 
        @if($story->likes->count() > 0)
          <span>@lang('Likeado'): {{ $story->likes->where('deleted_at',null)->count() }}</span>
        @endif
        <span>@lang('Partes'): {{ $story->textNodes->count() }}</span>
      </div>

      <p><a href="{{ route('story.show', $story->slug ) }}" class="btn btn-primary">@lang('Leer!')</a></p>
    </div>
  </div>
